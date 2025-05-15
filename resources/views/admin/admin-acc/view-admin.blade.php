<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/orders') }}">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/order-items') }}">Order Items</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/payments') }}">Payments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/reviews') }}">Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/users') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/admin-acc') }}">Admin</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Admin Account</h2>
        <a href="{{ route('menu.create') }}">Tambah Menu</a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menu as $id => $row)
                    <tr>
                        <td>{{ $id +1 }}</td>
                        <td>{{ $row->menu_nama }}</td>
                        <td>{{ $row->menu_deskripsi }}</td>
                        <td>Rp{{ number_format($row->menu_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="{{ $row->status == 'tersedia' ? 'text-success' : 'text-danger' }}">
                                {{ ucfirst($row->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('menu.edit', $row->menu_id) }}">Edit</a> |
                            <form action="{{ route('menu.destroy', $row->menu_id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
