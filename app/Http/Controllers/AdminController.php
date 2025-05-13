<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class AdminController extends Controller
{
    public function index()
    {
        $rows = Menu::all(); // ambil semua data dari tabel tb_menu
        return view('admin.index', compact('rows'));
    }

    public function login()
    {
        // Menampilkan form login admin (jika perlu halaman khusus)
        return view('auth.login'); // atau sesuaikan dengan file login kamu
    }

    public function profile()
    {
        // Menampilkan profil admin
        return view('admin.profile'); // pastikan file ini ada
    }
}
