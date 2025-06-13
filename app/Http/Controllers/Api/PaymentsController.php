<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payments::with('orders')->latest()->get();

        return response()->json([
            'orders_id' => 'required|exists:tb_orders,orders_id',
            'status' => true,
            'message' => 'Daftar semua pembayaran',
            'data' => $payments
        ]);
    }

    public function show($id)
    {
        $payment = Payments::with('orders')->find($id);

        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail pembayaran',
            'data' => $payment
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'orders_id' => 'required|exists:tb_orders,orders_id',
            'metode_pembayaran' => 'required|in:gopay,ovo,dana,bank_transfer,cod',
        ]);

        $order = Orders::where('orders_id', $request->orders_id)->firstOrFail();

        // Pastikan pesanan belum ada pembayaran
        if ($order->payment) {
            return response()->json([
                'status' => false,
                'message' => 'Pesanan ini sudah memiliki pembayaran'
            ], 400);
        }

        // Buat pembayaran baru
        $payment = Payments::create([
            'orders_id' => $order->orders_id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_pembayaran' => $order->total_price,
            'status' => $request->metode_pembayaran === 'cod' ? 'pending' : 'paid',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran berhasil diproses',
            'data' => $payment
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $payment = Payments::find($id);

        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'orders_id' => 'required|exists:tb_orders,orders_id',
            'metode_pembayaran' => 'sometimes|required|in:gopay,ovo,dana,bank_transfer,cod',
            'status' => 'sometimes|required|in:paid,pending,failed',
        ]);

        $payment->update($request->only(['metode_pembayaran', 'status']));

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran berhasil diperbarui',
            'data' => $payment
        ]);
    }

    public function destroy($id)
    {
        $payment = Payments::find($id);

        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran berhasil dihapus'
        ]);
    }
}
