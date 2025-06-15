<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramen Rush</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<header class="header">
    <div class="nav-container">
        <a href="#" class="logo">RamenRush</a>

        <nav>
            <ul class="nav-menu">
                <li><a href="{{ route('landing') }}">Home</a></li>
                <li><a href="{{ route('menu') }}">Menu</a></li>
                <li><a href="{{ route('order') }}">Order</a></li>
@php
    $user = Auth::guard('customers')->user();
@endphp

@if($user)
    <li class="nav-user">
        <span>👤 {{ $user->users_nama }}</span>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: #f00; cursor: pointer;">Logout</button>
        </form>
    </li>
@else
    <li><a href="{{ route('registrasiForm') }}">Register</a></li>
    <li><a href="{{ route('loginForm') }}">Login</a></li>
@endif


                    <li><a href="#">Kontak</a></li>
                </ul>

        </nav>


    </div>
</header>
        @yield('content')
</body>
<body style="margin: 0; padding: 0;">
    <div style="min-height: 100vh; display: flex; flex-direction: column;">

        {{-- Konten halaman --}}
        <main style="flex: 1;">
            <!-- Hero section, menu, dsb -->
        </main>
<footer style="background-color: #ff0000; color: #fff; padding: 40px 0; text-align: center;">
    <div style="max-width: 500px; margin: 0 auto; padding: 0 20px;">

        <h2 style="font-family: 'Segoe UI', sans-serif; font-size: 24px; margin-bottom: 10px;">
            🍜 RamenRush
        </h2>
        <p style="margin-bottom: 20px; color: #ccc;">
            Autentik Ramen Jepang dengan cita rasa terbaik — langsung dari dapur kami ke hatimu.
        </p>

        <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; margin-bottom: 20px;">
            <a href="{{ route('landing') }}" style="color: #ccc; text-decoration: none;">Home</a>
            <a href="{{ route('menu') }}" style="color: #ccc; text-decoration: none;">Menu</a>
            <a href="{{ route('order') }}" style="color: #ccc; text-decoration: none;">Order</a>
            <a href="#" style="color: #ccc; text-decoration: none;">Kontak</a>
        </div>

        <div style="margin-bottom: 10px;">
            <a href="https://instagram.com" target="_blank" style="margin: 0 10px; color: #fff;">📷 Instagram</a>
            <a href="https://tiktok.com" target="_blank" style="margin: 0 10px; color: #fff;">🎵 TikTok</a>
            <a href="mailto:info@ramenrush.com" style="margin: 0 10px; color: #fff;">📧 Email</a>
        </div>

        <p style="font-size: 14px; color: #777;">
            &copy; {{ date('Y') }} RamenRush. All rights reserved.
        </p>
    </div>
</footer>

</html>
