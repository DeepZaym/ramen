<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Menu;

class AdminController extends Controller
{
    public function index()
    {
        $menu = Menu::all(); // ambil semua data dari tabel tb_menu
        return view('admin.index', compact('menu'));
    }

    public function login()
    {
        // Menampilkan form login admin (jika perlu halaman khusus)
        return view('auth.login'); // atau sesuaikan dengan file login kamu
    }
  // Tampilkan semua data admin
    public function adminAcc()
    {
        $admins = Admin::all();
        return view('admin.admin-acc.view-admin', compact('admins'));
    }

    // Tampilkan form tambah admin
    public function createAdmin()
    {
        return view('admin.admin-acc.create');
    }

    // Simpan admin baru
    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admin,email',
        'password' => 'required|min:7',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.admin-acc')->with('success', 'Admin berhasil ditambahkan!');
    }

    // Tampilkan form edit admin
    public function editAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin-acc.edit', compact('admin'));
    }

    // Simpan perubahan admin
    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:admin,email,' . $id,
            'password' => 'nullable|string|min:7',
        ]);

        $admin = Admin::findOrFail($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        return redirect()->route('admin.admin-acc')->with('success', 'Admin berhasil diperbarui!');
    }

    // Hapus admin
    public function deleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admin-acc')->with('success', 'Admin berhasil dihapus!');
    }

    
}