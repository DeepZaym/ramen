<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Kembali</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Tambah Pengguna Baru</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="users_nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="users_nama" name="users_nama" value="{{ old('users_nama') }}" required>
            </div>

            <div class="mb-3">
                <label for="users_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="users_email" name="users_email" value="{{ old('users_email') }}" required>
            </div>

            <div class="mb-3">
                <label for="users_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="users_password" name="users_password" required>
            </div>

            <div class="mb-3">
                <label for="users_alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="users_alamat" name="users_alamat" rows="3" required>{{ old('users_alamat') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
