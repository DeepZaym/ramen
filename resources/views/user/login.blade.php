<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna</title>
</head>
<body>
    <div>
        <h2>Login Pengguna</h2>
        <p>Silahkan masuk dengan menggunakan akun yang sudah anda daftarkan</p>
        <form action="{{ route('login.submit') }}" method="post">
            @csrf
            <label>Email Address</label>
            <input type="text" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>
            <button>Submit Login</button>
        </form>

        @if(session('gagal'))
        <p>{{ session('gagal') }}</p>
        @endif
    </div>
</body>
</html>