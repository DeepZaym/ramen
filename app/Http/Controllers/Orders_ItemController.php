<?php

namespace App\Http\Controllers;

use App\Models\Orders_Item;
use App\Models\Menu;
use App\Models\Orders;
use App\Models\Users;
use Illuminate\Http\Request;

class Orders_ItemController extends Controller
{
    public function index()
    {
        $items = Orders_Item::with('menu', 'orders')->latest()->get();
        return view('admin.order-items.view-orderitems', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'orders_id' => 'required|exists:orders,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $price = \App\Models\Menu::find($request->menu_id)->harga;

        $item = Orders_Item::create([
            'orders_id' => $request->orders_id,
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'price' => $price,
        ]);

        return response()->json([
            'message' => 'Item pesanan berhasil ditambahkan',
            'data' => $item
        ], 201);
    }

    public function show($id)
    {
        $item = Orders_Item::with('menu', 'orders')->findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Orders_Item::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->quantity = $request->quantity;
        $item->save();

        return response()->json([
            'message' => 'Item pesanan diperbarui',
            'data' => $item
        ]);
    }

    public function destroy($id)
    {
        $item = Orders_Item::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item pesanan berhasil dihapus']);
    }
}
