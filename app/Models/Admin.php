<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan Dashboard Admin
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // Menampilkan halaman profile admin
    public function profile()
    {
        return view('admin.profile');
    }
}
