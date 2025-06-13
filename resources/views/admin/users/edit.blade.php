<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->users_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="users_nama" class="form-label">Nama</label>
                <input type="text" name="users_nama" class="form-control" value="{{ old('users_nama', $user->users_nama) }}" required>
            </div>

            <div class="mb-3">
                <label for="users_email" class="form-label">Email</label>
                <input type="email" name="users_email" class="form-control" value="{{ old('users_email', $user->users_email) }}" required>
            </div>

            <div class="mb-3">
                <label for="users_password" class="form-label">Password (Biarkan kosong jika tidak ingin diubah)</label>
                <input type="password" name="users_password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="users_alamat" class="form-label">Alamat</label>
                <input type="text" name="users_alamat" class="form-control" value="{{ old('users_alamat', $user->users_alamat) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
