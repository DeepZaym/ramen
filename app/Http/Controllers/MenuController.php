<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Tampilkan semua menu.
     */
    public function index()
    {
        $menus = Menu::latest()->get();
        return response()->json($menus);
    }

    /**
     * Simpan menu baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|string|max:50',
            'gambar' => 'nullable|string', // base64 atau URL jika ada
        ]);

        $menu = Menu::create($request->all());

        return response()->json([
            'message' => 'Menu berhasil ditambahkan',
            'data' => $menu
        ], 201);
    }

    /**
     * Tampilkan satu menu berdasarkan ID.
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    /**
     * Update menu berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'sometimes|required|numeric|min:0',
            'kategori' => 'sometimes|required|string|max:50',
            'gambar' => 'nullable|string',
        ]);

        $menu->update($request->all());

        return response()->json([
            'message' => 'Menu berhasil diperbarui',
            'data' => $menu
        ]);
    }

    /**
     * Hapus menu berdasarkan ID.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json([
            'message' => 'Menu berhasil dihapus'
        ]);
    }
}
