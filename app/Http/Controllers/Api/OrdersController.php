<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::with('user')->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'users_id' => 'required|exists:tb_users,users_id',
            'status' => 'nullable|string',
            'delivery_address' => 'required|string',
            'total_price' => 'required|numeric'
        ]);

        $orders = Orders::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Orders berhasil ditambahkan.',
            'data' => $orders
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orders = Orders::find($id);

        if (!$orders) {
            return response()->json([
                'success' => false,
                'message' => 'Orders tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $orders = Orders::find($id);

        if (!$orders) {
            return response()->json([
                'success' => false,
                'message' => 'Orders tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'users_id' => 'sometimes|required|exists:tb_users,users_id',
            'status' => 'nullable|string',
            'delivery_address' => 'sometimes|required|string',
            'total_price' => 'sometimes|required|numeric'
        ]);

        $orders->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Orders berhasil diperbarui.',
            'data' => $orders
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orders = Orders::find($id);

        if (!$orders) {
            return response()->json([
                'success' => false,
                'message' => 'Orders tidak ditemukan.'
            ], 404);
        }

        $orders->delete();

        return response()->json([
            'success' => true,
            'message' => 'Orders berhasil dihapus.'
        ], 200);
    }
}
