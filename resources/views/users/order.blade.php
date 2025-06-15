@extends('layouts.pemesanan')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RamenRush - Pemesanan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
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
            margin-top: 80px;
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

        .payment-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .menu-selection {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            border-radius: 2px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 20px;
            margin-bottom: 15px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .menu-item:hover {
            background: white;
            border-color: #e74c3c;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            margin-right: 20px;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .item-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .item-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #e74c3c;
        }

        .item-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .quantity-btn {
            background: #e74c3c;
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .quantity-btn:hover {
            background: #c0392b;
            transform: scale(1.1);
        }

        .quantity-btn:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
            transform: none;
        }

        .quantity-display {
            background: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            color: #2c3e50;
            min-width: 40px;
            text-align: center;
            border: 2px solid #e9ecef;
        }

        .order-summary {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            height: fit-content;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-name {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .cart-item-details {
            color: #666;
            font-size: 0.9rem;
        }

        .cart-item-price {
            font-weight: bold;
            color: #e74c3c;
            font-size: 1.1rem;
        }

        .order-total {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin: 25px 0;
            text-align: center;
        }

        .total-label {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .total-amount {
            font-size: 2rem;
            font-weight: bold;
        }

        .payment-form {
            margin-top: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #e74c3c;
            background: white;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .payment-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 15px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .payment-option:hover {
            border-color: #e74c3c;
            background: white;
            transform: translateY(-2px);
        }

        .payment-option.selected {
            border-color: #e74c3c;
            background: #e74c3c;
            color: white;
        }

        .payment-icon {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .payment-name {
            font-weight: 600;
            font-size: 0.9rem;
            text-align: center;
        }

        .payment-btn {
            width: 100%;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }

        .payment-btn:hover {
            background: linear-gradient(135deg, #c0392b, #a93226);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(231, 76, 60, 0.3);
        }

        .payment-btn:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .empty-cart {
            text-align: center;
            color: #666;
            padding: 40px 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .empty-cart-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .success-modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }

        .success-content {
            background: white;
            margin: 10% auto;
            padding: 40px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            animation: successSlideIn 0.5s ease-out;
        }

        @keyframes successSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .success-icon {
            font-size: 4rem;
            color: #27ae60;
            margin-bottom: 20px;
        }

        .success-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .success-message {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .order-id {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: #e74c3c;
        }

        .back-btn {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(52, 152, 219, 0.3);
        }

        @media (max-width: 768px) {
            .payment-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .page-title {
                font-size: 2rem;
            }

            .menu-item {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .item-image {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .payment-methods {
                grid-template-columns: repeat(2, 1fr);
            }

            .nav-menu {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .payment-methods {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">RamenRush</a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#tentang">Tentang Kami</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="menu-selection">
  <h2 class="section-title">Pilih Menu</h2>

  @if($menus->isEmpty())
    <p style="color:red;">Tidak ada menu tersedia.</p>
  @endif

  @foreach($menus as $m)
  <div class="menu-item"
       data-id="{{ $m->menu_id }}"
       data-name="{{ $m->menu_nama }}"
       data-price="{{ $m->menu_harga }}">
<img src="{{ asset('img/' . $m->foto) }}" alt="Gambar Menu" width="100">
    <div class="item-info">
      <div class="item-name">{{ $m->menu_nama }}</div>
      <div class="item-description">{{ $m->menu_deskripsi }}</div>
      <div class="item-price">Rp {{ number_format($m->menu_harga,0,',','.') }}</div>
    </div>
    <div class="item-controls">
      <button class="quantity-btn" onclick="updateQuantity({{ $m->menu_id }}, -1)">-</button>
      <div class="quantity-display" id="qty-{{ $m->menu_id }}">0</div>
      <button class="quantity-btn" onclick="updateQuantity({{ $m->menu_id }}, 1)">+</button>
    </div>
  </div>
  <form method="POST" action="{{ route('submit') }}" onsubmit="return submitOrder(event)">
  @csrf
  <input type="hidden" name="items" id="items-input">
  <input type="hidden" name="delivery_address" value="{{ $user->users_alamat }}">
  <button type="submit">Pesan Sekarang</button>
</form>
  @endforeach
</div>

<script>
  const cart = {};

  function updateQuantity(menuId, delta) {
    const qtyDisplay = document.getElementById(`qty-${menuId}`);
    let currentQty = parseInt(qtyDisplay.innerText);
    let newQty = currentQty + delta;

    if (newQty < 0) return;

    qtyDisplay.innerText = newQty;

    if (newQty === 0) {
      delete cart[menuId];
    } else {
      cart[menuId] = newQty;
    }

    console.log("Cart:", cart);
  }

  function submitOrder(event) {
    event.preventDefault();

    const items = Object.entries(cart).map(([menu_id, quantity]) => ({
      menu_id,
      quantity
    }));

    if (items.length === 0) {
      alert("Silakan pilih menu terlebih dahulu.");
      return false;
    }

    document.getElementById("items-input").value = JSON.stringify(items);
    event.target.submit();
  }
</script>
