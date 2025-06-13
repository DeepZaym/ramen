<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: #d3d3d3;
            padding: 30px 20px;
            border-radius: 5px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 360px;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, rgb(255, 0, 25), rgb(255, 0, 25));
        }

        .login-title {
            color: rgb(255, 0, 25);
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 18px 20px;
            border: 2px solid transparent;
            border-radius: 8px;
            background: #ffffff;
            font-size: 16px;
            color: #333;
            transition: all 0.3s ease;
            outline: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-input::placeholder {
            color: #999;
        }

        .form-input:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
            transform: translateY(-2px);
        }

        .form-input:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-input.error {
            border-color: #dc3545;
            animation: shake 0.5s ease-in-out;
        }

        .login-btn {
            width: 100%;
            max-width: 180px;
            padding: 15px 30px;
            background: linear-gradient(135deg, rgb(255, 0, 25), rgb(255, 0, 25));
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 30px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 0, 25, 0.4);
        }

        .form-links {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .form-links a {
            color: rgb(255, 0, 25);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            position: relative;
        }

        .form-links a:hover::after {
            width: 100%;
        }

        .form-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -3px;
            left: 0;
            background: rgb(255, 0, 25);
            transition: width 0.3s ease;
        }

        .alert {
            margin-bottom: 15px;
            color: #dc3545;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        ul.error-list {
            margin: 0; padding-left: 0;
            list-style-type: none;
        }

        ul.error-list li::before {
            content: "• ";
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="login-title">Log-in</h1>

        {{-- Error Messages --}}
        @if (session('gagal'))
            <div class="alert">{{ session('gagal') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="loginForm" action="{{ route('submitLogin') }}" method="POST">
            @csrf
            <div class="form-group">
                <input 
                    type="text" 
                    name="username"
                    class="form-input @error('users_nama') error @enderror" 
                    id="users_nama" 
                    placeholder="nama" 
                    required
                    value="{{ old('users_nama') }}"
                    autocomplete="users_nama"
                >
            </div>
            
            <div class="form-group">
                <input 
                    type="password" 
                    name="password"
                    class="form-input @error('password') error @enderror" 
                    id="password" 
                    placeholder="Password" 
                    required
                    autocomplete="current-password"
                >
            </div>
            
            <button type="submit" class="login-btn">
                Login
            </button>
        </form>

        <div class="form-links">
            <a href="{{ route('registrasiForm') }}">Register</a>
        </div>
    </div>
</body>
</html>
