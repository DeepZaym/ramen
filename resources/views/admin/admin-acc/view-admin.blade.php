<!DOCTYPE html>
<html>
<head>
    <title>Admin Management</title>
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
                <li class="nav-item"><a class="nav-link" href="{{ route('payments.index') }}">Payments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reviews.index') }}">Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('admin.admin-acc') }}">Admin</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Admin</h2>
            <a href="{{ route('admin.create-admin') }}" class="btn btn-primary">Tambah Admin</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Dibuat</th>
                    <th>Diubah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $index => $admin)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $admin->nama ?? $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->password }}</td>
                        <td>{{ $admin->created_at }}</td>
                        <td>{{ $admin->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.edit-admin', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.delete-admin', $admin->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus admin ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if($admins->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data admin.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
