<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Akun</title>
  <style>
    body {
      background-color: white;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 300px;
      background-color: #d9d9d9;
      padding: 30px 20px;
      margin: 80px auto;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
    }

    h2 {
      color: #b30000;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      background-color: #b30000;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      margin-top: 15px;
      cursor: pointer;
    }

    button:hover {
      background-color: #990000;
    }

    .links {
      margin-top: 15px;
    }

    .links a {
      color: #b30000;
      margin: 0 8px;
      text-decoration: none;
      font-size: 14px;
    }

    .links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Register</h2>
    <form action="{{ route('submitRegistrasi') }}" method="POST">
      @csrf
      <input type="text" name="users_nama" placeholder="Nama Lengkap" value="{{ old('users_nama') }}" required />
      <input type="email" name="users_email" placeholder="Email" value="{{ old('users_email') }}" required />
      <input type="text" name="users_alamat" placeholder="Alamat" value="{{ old('users_alamat') }}" required />
      <input type="password" name="users_password" placeholder="Password" required />
      <input type="password" name="users_password_confirmation" placeholder="Konfirmasi Password" required />
      <button type="submit">Register</button>
    </form>

    @if ($errors->any())
      <div style="color: red; margin-top: 10px;">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="links">
      <a href="{{ route('loginForm') }}">Login</a>
    </div>
  </div>


</body>
</html>
