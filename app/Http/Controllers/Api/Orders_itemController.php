<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders_Item;
use App\Models\Menu;
use Illuminate\Http\Request;

class Orders_ItemController extends Controller
{
    /**
     * Tampilkan semua item pesanan.
     */
    public function index()
    {
        $items = Orders_Item::with('menu', 'orders')->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $items
        ], 200);
    }

    /**
     * Tambahkan item pesanan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'orders_id' => 'required|exists:tb_orders,orders_id',
            'menu_id' => 'required|exists:tb_menu,menu_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu = Menu::find($validated['menu_id']);
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan.'
            ], 404);
        }

        $price = $menu->harga;

        $item = Orders_Item::create([
            'orders_id' => $validated['orders_id'],
            'menu_id' => $validated['menu_id'],
            'quantity' => $validated['quantity']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item pesanan berhasil ditambahkan.',
            'data' => $item
        ], 201);
    }

    /**
     * Tampilkan item pesanan tertentu.
     */
    public function show($id)
    {
        $item = Orders_Item::with('menu', 'orders')->find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $item
        ], 200);
    }

    /**
     * Update item pesanan tertentu.
     */
    public function update(Request $request, $id)
    {
        $item = Orders_Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->quantity = $validated['quantity'];
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Item pesanan berhasil diperbarui.',
            'data' => $item
        ]);
    }

    /**
     * Hapus item pesanan.
     */
    public function destroy($id)
    {
        $item = Orders_Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan.'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item pesanan berhasil dihapus.'
        ]);
    }
}
