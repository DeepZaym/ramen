<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // GET /api/Admin
    public function index()
    {
        $Admin = Admin::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'Daftar semua admin',
            'data' => $Admin
        ]);
    }

    // GET /api/Admin/{id}
    public function show($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'Admin tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail Admin',
            'data' => $admin
        ]);
    }

    // POST /api/Admin
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:191',
            'email' => 'required|email|unique:admin,email',
            'password' => 'required|string|min:7'
        ]);

        $Admin = Admin::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Admin berhasil ditambahkan',
            'data' => $Admin
        ], 201);
    }

    // PUT /api/Admin/{id}
    public function update(Request $request, $id)
    {
        $Admin = Admin::find($id);

        if (!$Admin) {
            return response()->json([
                'status' => false,
                'message' => 'Admin tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|required|string|max:191',
            'email' => 'sometimes|required|email|unique:Admin,email,' . $id . ',id',
            'password' => 'nullable|string|min:7',
            'alamat' => 'sometimes|required|string|max:191'
        ]);

        $Admin->update([
            'nama' => $request->nama ?? $Admin->nama,
            'email' => $request->email ?? $Admin->email,
            'password' => $request->password ? Hash::make($request->password) : $Admin->password,
            'alamat' => $request->alamat ?? $Admin->alamat
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Admin berhasil diperbarui',
            'data' => $Admin
        ]);
    }

    // DELETE /api/Admin/{id}
    public function destroy($id)
    {
        $Admin = Admin::find($id);

        if (!$Admin) {
            return response()->json([
                'status' => false,
                'message' => 'Admin tidak ditemukan'
            ], 404);
        }

        $Admin->delete();

        return response()->json([
            'status' => true,
            'message' => 'Admin berhasil dihapus'
        ]);
    }
}
