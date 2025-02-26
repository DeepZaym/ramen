<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
</head>
<body>
    <div class="text-center">
        <h2>Registrasi Pengguna</h2>
        <p>Silahkan isi formulir berikut untuk registrasi</p>
        <form action="{{ route('registrasi.submit') }}" method="post">
            @csrf
            <label>Nama Lengkap</label>
            <input type="text" name="name" required>

            <label>Email Address</label>
            <input type="text" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>
            <button class="btn btn primary">Submit Registrasi</button>
        </form>
    </div>
</body>
</html>