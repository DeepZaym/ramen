<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('orders.index') }}">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('items.index') }}">Order Items</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('payments.index') }}">Payments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reviews.index') }}">Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin-acc') }}">Admin</a></li>
            </ul>
        </div>
</nav>
<body>
    <div class="container mt-5">
        <h2>Daftar Pesanan</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Alamat</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->orders_id }}</td>
                        <td>{{ $order->user ? $order->user->users_nama : 'N/A' }}</td>
                        <td>{{ $order->delivery_address }}</td>
                        <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <form action="{{ route('orders.destroy', $order->orders_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus pesanan ini?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            <a href="{{ route('orders.edit', $order->orders_id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
