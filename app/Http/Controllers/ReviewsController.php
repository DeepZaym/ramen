<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\Users;
use App\Models\Menu;

use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Tampilkan semua ulasan.
     */
    public function index()
    {
        $reviews = Reviews::with('user', 'menu')->latest()->get();
        return view('admin.reviews.view-reviews', compact('reviews'));
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

        $reviews = Reviews::create([
            'users_id' => $request->users_id,
            'menu_id' => $request->menu_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Review berhasil ditambahkan',
            'data' => $reviews
        ], 201);
    }

    /**
     * Tampilkan detail ulasan.
     */
    public function show($id)
    {
        $reviews = Reviews::with('user', 'menu')->findOrFail($id);
        return response()->json($reviews);
    }

    /**
     * Update review (jika user ingin mengedit review-nya).
     */
    public function update(Request $request, $id)
    {
        $reviews = Reviews::findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $reviews->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Review diperbarui',
            'data' => $reviews
        ]);
    }

    /**
     * Hapus review.
     */
    public function destroy($id)
    {
        $reviews = Reviews::findOrFail($id);
        $reviews->delete();

        return response()->json(['message' => 'Review berhasil dihapus']);
    }
}
