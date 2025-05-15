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
        $menu = Menu::all();
        return view('admin.index', compact('menu'));
    }

    /**
     * Tampilkan form tambah menu.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Simpan menu baru.
     */
   public function store(Request $request)
    {
    $request->validate([
        'menu_nama' => 'required|string|max:100',
        'menu_deskripsi' => 'nullable|string',
        'menu_harga' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
    ]);

    $data = $request->all();
    $data['status'] = $data['stok'] > 0 ? 1 : 0;

    Menu::create($data);

    return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan');
    }


    /**
     * Tampilkan form edit.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    /**
     * Update menu berdasarkan ID.
     */
    public function update(Request $request, $id)
{
    $menu = Menu::findOrFail($id);

    $request->validate([
        'menu_nama' => 'required|string|max:100',
        'menu_deskripsi' => 'nullable|string',
        'menu_harga' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
    ]);

    $data = $request->only(['menu_nama', 'menu_deskripsi', 'menu_harga', 'stok']);
    $data['status'] = $data['stok'] > 0 ? 'tersedia' : 'habis';

    $menu->update($data);

    return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui');
}


    /**
     * Hapus menu berdasarkan ID.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus');
    }
    // Update stok dan status otomatis saat menyimpan menu
    public function updateStok(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $menu->stok = $request->stok;
        $menu->status = $menu->stok > 0 ? 1 : 0;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Stok dan status diperbarui.');
    }

    // Simulasi pemesanan
    public function order(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($menu->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $menu->stok -= $request->jumlah;
        $menu->status = $menu->stok > 0 ? 1 : 0;
        $menu->save();

        return back()->with('success', 'Pesanan berhasil, stok diperbarui.');
    }
}


