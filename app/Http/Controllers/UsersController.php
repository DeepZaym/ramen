<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Tampilkan semua user.
     */
    public function index()
    {
        return view('user.landing', [
            'user' => User::get(), 
        ]);
    }

    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $users = Users::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User berhasil ditambahkan',
            'data'    => $users
        ], 201);
    }

    /**
     * Tampilkan detail user.
     */
    public function show($id)
    {
        $users = Users::findOrFail($id);
        return response()->json($users);
    }

    /**
     * Update data user.
     */
    public function update(Request $request, $id)
    {
        $users = Users::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:users,email,' . $users->id,
            'password' => 'nullable|min:6',
        ]);

        $users->name  = $request->name ?? $users->name;
        $users->email = $request->email ?? $users->email;

        if ($request->password) {
            $users->password = Hash::make($request->password);
        }

        $users->save();

        return response()->json([
            'message' => 'User berhasil diperbarui',
            'data'    => $users
        ]);
    }

    /**
     * Hapus user.
     */
    public function destroy($id)
    {
        $users = Users::findOrFail($id);
        $users->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }

    /**
     * Tampilkan halaman order.
     */
    public function orderPage()
    {
        return view('user.order');

    }
    
}
