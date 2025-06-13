<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Admin</h2>
    <a href="{{ route('admin.admin-acc') }}" class="btn btn-secondary mb-3">← Kembali</a>

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

    <form action="{{ route('admin.update-admin', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">name Admin</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $admin->name) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Admin</label>
            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email', $admin->email) }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi (opsional)</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
</body>
</html>
