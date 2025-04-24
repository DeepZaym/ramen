<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Tampilkan semua ulasan.
     */
    public function index()
    {
        $Reviews = Reviews::with('users', 'menu')->latest()->get();
        return response()->json($Reviews);
    }

    /**
     * Simpan ulasan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'menu_id' => 'required|exists:menu,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $Reviews = Reviews::create([
            'users_id' => $request->users_id,
            'menu_id' => $request->menu_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Review berhasil ditambahkan',
            'data' => $Reviews
        ], 201);
    }

    /**
     * Tampilkan detail ulasan.
     */
    public function show($id)
    {
        $Reviews = Reviews::with('user', 'menu')->findOrFail($id);
        return response()->json($Reviews);
    }

    /**
     * Update review (jika user ingin mengedit review-nya).
     */
    public function update(Request $request, $id)
    {
        $Reviews = Reviews::findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $Reviews->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Review diperbarui',
            'data' => $Reviews
        ]);
    }

    /**
     * Hapus review.
     */
    public function destroy($id)
    {
        $Reviews = Reviews::findOrFail($id);
        $Reviews->delete();

        return response()->json(['message' => 'Review berhasil dihapus']);
    }
}
