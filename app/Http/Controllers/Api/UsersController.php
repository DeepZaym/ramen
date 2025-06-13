<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function loginForm() {
        return view('Ramen.login');
    }

    public function registrasiForm() {
        return view('Ramen.registrasi');
    }

    public function submitRegistrasi(Request $request) {
        $request->validate([
            'users_nama' => 'required|string|max:255|unique:tb_users',
            'users_email' => 'required|email|unique:tb_users',
            'users_password' => 'required|min:7|confirmed',
            'users_alamat' => 'required|string|max:255',
        ]);

        Users::create([
            'users_nama' => $request->users_nama,
            'users_email' => $request->users_email,
            'users_password' => Hash::make($request->users_password),
            'users_alamat' => $request->users_alamat,
        ]);

        return redirect()->route('loginForm')->with('success', 'Registrasi berhasil!');
    }

    public function submitLogin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Manual authentication for custom Users model
        $user = Users::where('users_nama', $request->username)->first();

        if ($user && Hash::check($request->password, $user->users_password)) {
            // Log the user in manually
            Auth::guard('users')->login($user);
            $request->session()->regenerate();
            return redirect()->route('landing')->with('success', 'Login berhasil');
        }

        return back()->with('gagal', 'Username atau password salah');
    }

    public function landing() {
        return view('users.landing');
    }

    public function logout(Request $request) {
        Auth::guard('users')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm');
    }

    // Menu method
    public function menu() {
        return view('users.menu');
    }

    // Pembayaran method
    public function pembayaran() {
        return view('users.pembayaran');
    }

    // CRUD methods for admin
    public function index() {
        $users = Users::all();
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'users_nama' => 'required|string|max:255|unique:tb_users',
            'users_email' => 'required|email|unique:tb_users',
            'users_password' => 'required|min:7',
            'users_alamat' => 'required|string|max:255',
        ]);

        Users::create([
            'users_nama' => $request->users_nama,
            'users_email' => $request->users_email,
            'users_password' => Hash::make($request->users_password),
            'users_alamat' => $request->users_alamat,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id) {
        $user = Users::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = Users::findOrFail($id);
        
        $request->validate([
            'users_nama' => 'required|string|max:255|unique:tb_users,users_nama,' . $id . ',users_id',
            'users_email' => 'required|email|unique:tb_users,users_email,' . $id . ',users_id',
            'users_alamat' => 'required|string|max:255',
        ]);

        $updateData = [
            'users_nama' => $request->users_nama,
            'users_email' => $request->users_email,
            'users_alamat' => $request->users_alamat,
        ];

        if ($request->filled('users_password')) {
            $updateData['users_password'] = Hash::make($request->users_password);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id) {
        $user = Users::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}