<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Lihat semua pembayaran.
     */
    public function index()
    {
        $payments = Payments::with('orders.users')->latest()->get();
        return response()->json($payments);
    }

    /**
     * Buat pembayaran untuk pesanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'orders_id' => 'required|exists:orders,id',
            'metode_pembayaran' => 'required|in:gopay,ovo,dana,bank_transfer,cod',
        ]);

        $orders = Orders::findOrFail($request->orders_id);

        if ($orders->payments) {
            return response()->json(['message' => 'Pesanan ini sudah dibayar'], 400);
        }

        $payments = Payments::create([
            'orders_id' => $orders->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_pembayaran' => $orders->total_price,
            'status_pembayaran' => $request->metode_pembayaran === 'cod' ? 'pending' : 'paid',
        ]);

        return response()->json([
            'message' => 'Pembayaran berhasil diproses',
            'data' => $payments
        ]);
    }
}