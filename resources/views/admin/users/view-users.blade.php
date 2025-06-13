<!DOCTYPE html>
<html>
<head>
    <title>Data Review</title>
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
                <li class="nav-item"><a class="nav-link active" href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin-acc') }}">Admin</a></li>
            </ul>
        </div>
    </nav>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Pengguna</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">+ Tambah User</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->users_nama }}</td>
                    <td>{{ $user->users_email }}</td>
                    <td>{{ $user->users_alamat }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->users_id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.users.destroy', $user->users_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data pengguna.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
