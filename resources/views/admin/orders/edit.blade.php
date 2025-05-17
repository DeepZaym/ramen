@extends('layouts.app')

@section('content')
<h2>Edit Pesanan</h2>
<form action="{{ route('orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>User</label>
    <select name="users_id" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $user->id == $order->users_id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>

    <label>Alamat Pengiriman</label>
    <input type="text" name="delivery_address" value="{{ $order->delivery_address }}" required>

    <label>Status</label>
    <select name="status" required>
        @foreach(['pending', 'preparing', 'on_delivery', 'delivered', 'cancelled'] as $status)
            <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>

    <p><strong>Note:</strong> Untuk mengedit item, silakan hapus dan buat ulang pesanan.</p>

    <button type="submit">Update</button>
</form>
@endsection
