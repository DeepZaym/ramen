<!DOCTYPE html>
<html>
<head>
    <title>Data Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('items.index') }}">Order Items</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('payments.index') }}">Payments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reviews.index') }}">Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin-acc') }}">Admin</a></li>
            </ul>
        </div>
    </nav>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4">Data Pembayaran</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $payment->payments_id }}</td>
                                <td>{{ $payment->orders_id }}</td>
                                <td>{{ ucfirst($payment->metode_pembayaran) }}</td>
                                <td>{{ ucfirst($payment->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data pembayaran.</td>
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
