<?php

namespace App\Http\Controllers;

use App\Models\OrdersItem;
use App\Models\Orders;
use App\Models\Orders_Item;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Tampilkan semua pesanan (order).
     */
    public function index()
    {
        $orders = Orders::with('users', 'ordersItems.menu')->latest()->get();
        return response()->json($orders);
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
            'items.*.menu_id' => 'required|exists:menus,id',
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
        $order = Orders::with('users', 'orders_Items.menu')->findOrFail($id);
        return response()->json($order);
    }

    /**
     * Update status pesanan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,on_delivery,delivered,cancelled',
        ]);

        $order = Orders::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Status pesanan diperbarui',
            'data' => $order
        ]);
    }

    /**
     * Hapus pesanan (opsional).
     */
    public function destroy($id)
    {
        $order = Orders::findOrFail($id);
        $order->orderItems()->delete();
        $order->delete();

        return response()->json(['message' => 'Pesanan berhasil dihapus']);
    }
}
