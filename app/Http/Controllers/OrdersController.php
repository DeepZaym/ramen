<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Orders;
use App\Models\Orders_Item;
use App\Models\Users;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Tampilkan semua pesanan (order).
     */
    public function index()
{
    $orders = \App\Models\Orders::with('user')
        ->orderBy('orders_id', 'asc') // urut berdasarkan ID (kecil ke besar)
        ->get();

    return view('admin.orders.view-orders', compact('orders'));
}



    public function pemesanan()
    {
        // Ambil hanya menu yang status-nya aktif dan stok-nya tersedia
        $menus = Menu::where('status', 'aktif')->where('stok', '>', 0)->get();

        return response()->json($menus);
    }


    /**
     * Simpan pesanan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'delivery_address' => 'required|string',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menu,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Hitung total harga
        $total = 0;
        foreach ($request->items as $item) {
            $menu = \App\Models\Menu::findOrFail($item['menu_id']);
            $total += $menu->harga * $item['quantity'];
        }

        // Simpan orders
        $orders = Orders::create([
            'users_id' => $request->user_id,
            'delivery_address' => $request->delivery_address,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        // Simpan item pesanan
        foreach ($request->items as $item) {
            Orders_Item::create([
                'orders_id' => $orders->id,
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
                'price' => \App\Models\Menu::find($item['menu_id'])->harga
            ]);
        }

        return response()->json([
            'message' => 'Pesanan berhasil dibuat',
            'data' => $orders->load('orderItems.menu')
        ], 201);
    }

    /**
     * Tampilkan satu pesanan.
     */
    public function show($id)
    {
        $orders = Orders::with('users', 'orders_Items.menu')->findOrFail($id);
        return response()->json($orders);
    }

    /**
     * Update status pesanan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,on_delivery,delivered,cancelled',
        ]);

        $orders = Orders::findOrFail($id);
        $orders->status = $request->status;
        $orders->save();

        return response()->json([
            'message' => 'Status pesanan diperbarui',
            'data' => $orders
        ]);
    }

    public function create()
    {
        $menu = Menu::where('status', 1)->get(); // hanya menu yang tersedia
        $users = Users::all();
        return view('admin.orders.create', compact('menu', 'users'));
    }

    public function edit($id)
    {
        $orders = Orders::with('ordersItems')->findOrFail($id);
        $menu = Menu::where('status', 1)->get();
        $users = Users::all();
        return view('admin.orders.edit', compact('orders', 'menu', 'users'));
    }

    /**
     * Hapus pesanan (opsional).
     */
    public function destroy($id)
    {
        $orders = Orders::findOrFail($id);
        $orders->orderItems()->delete();
        $orders->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus');

    }
}
