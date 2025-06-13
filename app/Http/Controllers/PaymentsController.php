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
        $payments = Payments::with('orders')->latest()->get();
        return view('admin.payments.view-payments', compact('payments'));
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

        if ($orders->payment) {
            return redirect()->back()->with('error', 'Pesanan ini sudah memiliki pembayaran.');
        }

        $payments = Payments::create([
            'orders_id' => $orders->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_pembayaran' => $orders->total_price,
            'status_pembayaran' => $request->metode_pembayaran === 'cod' ? 'pending' : 'paid',
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil diproses.');
    }
}