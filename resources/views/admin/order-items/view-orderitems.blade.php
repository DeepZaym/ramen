<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Orders</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('items.index') }}">Order Items</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('payments.index') }}">Payments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reviews.index') }}">Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin-acc') }}">Admin</a></li>
            </ul>
        </div>
    </nav>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4">Daftar Item Pesanan</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Nama User</th>
                            <th>Nama Menu</th>
                            <th>Qty</th>
                            <th>Alamat</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->orders_item_id }}</td>
                                <td>{{ $item->orders_id }}</td>
                                <td>{{ $item->orders->user->users_nama ?? '–' }}</td>
                                <td>{{ $item->menu->menu_nama ?? '–' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-start">{{ $item->orders->delivery_address }}</td>
                                <td>Rp{{ number_format($item->orders->total_price, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($item->orders->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Belum ada item pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
