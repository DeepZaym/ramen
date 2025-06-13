<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::all();
        return response()->json(['success' => true, 'data' => $menu], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = $data['stok'] > 0 ? 1 : 0;

        $menu = Menu::create($data);
        return response()->json(['success' => true, 'message' => 'Menu berhasil ditambahkan.', 'data' => $menu], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) return response()->json(['success' => false, 'message' =>
        'Menu tidak ditemukan.'], 404);
        return response()->json(['success' => true, 'data' => $menu], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) return response()->json(['success' => false, 'message' =>
        'Menu tidak ditemukan.'], 404);

        $validated = $request->validate([
        'menu_nama' => 'required|string|max:100',
        'menu_deskripsi' => 'nullable|string',
        'menu_harga' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
        ]);

        $menu->update($validated);
        return response()->json(['success' => true, 'message' => 'Menu berhasil
        diperbarui.', 'data' => $menu], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) return response()->json(['success' => false, 'message' =>
        'Menu tidak ditemukan.'], 404);
        $menu->delete();
        return response()->json(['success' => true, 'message' => 'Menu berhasil
        dihapus.'], 200);
    }
}
