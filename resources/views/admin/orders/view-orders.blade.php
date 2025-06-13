<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RamenRush - Daftar Pesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS Umum */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e74c3c;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu li a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s ease;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .nav-menu li a:hover,
        .nav-menu li a.active {
            color: #e74c3c;
        }

        .main-content {
            margin-top: 80px; /* Offset for fixed header */
            padding: 40px 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .page-title {
            text-align: center;
            font-size: 3rem;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .page-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 50px;
            font-style: italic;
        }

        /* Styling for Orders List */
        .orders-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .order-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden; /* For pseudo-element glow */
        }

        .order-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
            border-color: #e74c3c;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ddd;
        }

        .order-id {
            font-size: 1.4rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .order-date {
            font-size: 0.95rem;
            color: #888;
        }

        .order-status {
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background-color: #f39c12; /* Orange */
            color: white;
        }

        .status-processing {
            background-color: #3498db; /* Blue */
            color: white;
        }

        .status-completed {
            background-color: #27ae60; /* Green */
            color: white;
        }

        .status-cancelled {
            background-color: #e74c3c; /* Red */
            color: white;
        }

        .customer-info {
            margin-bottom: 20px;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .customer-info strong {
            color: #555;
        }

        .order-details-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .order-items {
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dotted #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-name-qty {
            font-weight: 500;
            color: #444;
        }

        .item-price {
            font-weight: bold;
            color: #e74c3c;
        }

        .order-total-summary {
            text-align: right;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .empty-orders {
            text-align: center;
            padding: 50px 20px;
            color: #666;
            background: #f8f9fa;
            border-radius: 12px;
            border: 1px dashed #ccc;
        }

        .empty-orders i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #bbb;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .order-date {
                text-align: left;
            }

            .order-status {
                width: fit-content;
            }

            .order-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .item-price {
                align-self: flex-end;
            }
        }

        @media (max-width: 480px) {
            .orders-container {
                padding: 20px;
            }

            .order-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <a href="/" class="logo">RamenRush</a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/menu">Menu</a></li>
                    <li><a href="/pemesanan">Pemesanan</a></li>
                    <li><a href="/pembayaran">Pembayaran</a></li>
                    <li><a href="/orders" class="active">Daftar Pesanan</a></li>
                    <li><a href="/tentang">Tentang Kami</a></li>
                    <li><a href="/kontak">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <h1 class="page-title">Daftar Pesanan Anda</h1>
        <p class="page-subtitle">Lihat riwayat dan status pesanan RamenRush Anda di sini.</p>

        <div class="orders-container">
            {{-- Blade directive to check if $orders variable is passed and not empty --}}
            @if ($orders->isEmpty())
                <div class="empty-orders">
                    <i class="fas fa-box-open"></i>
                    <p><strong>Belum ada pesanan yang ditemukan.</strong></p>
                    <p>Mulai pesan ramen favorit Anda sekarang!</p>
                    <a href="/pembayaran" class="payment-btn" style="display: inline-block; margin-top: 20px; text-decoration: none;">Pesan Sekarang</a>
                </div>
            @else
                {{-- Loop through each order --}}
                @foreach ($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-id">Order ID: {{ $order->order_id }}</div>
                            <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            <div class="order-status status-{{ Str::slug($order->status) }}">
                                {{ $order->status }}
                            </div>
                        </div>

                        <div class="customer-info">
                            <strong>Nama:</strong> {{ $order->customer_name }}<br>
                            <strong>Telepon:</strong> {{ $order->customer_phone }}<br>
                            <strong>Alamat:</strong> {{ $order->customer_address }}<br>
                            <strong>Metode Pembayaran:</strong> {{ $order->payment_method }}
                        </div>

                        <div class="order-details-title">Detail Pesanan</div>
                        <div class="order-items">
                            @foreach ($order->items as $item)
                                <div class="order-item">
                                    <span class="item-name-qty">{{ $item->name }} ({{ $item->quantity }}x)</span>
                                    <span class="item-price">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="order-total-summary">
                            Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </main>
</body>
</html>