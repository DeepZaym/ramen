<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Ramen</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
      background-color: #fff5f5;
      color: #333;
    }

    header {
      background-color: #b30000;
      color: white;
      padding: 1.5rem;
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .order-container {
      max-width: 600px;
      margin: 2rem auto;
      background: #ffeaea;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(179, 0, 0, 0.3);
    }

    .order-container h2 {
      text-align: center;
      color: #b30000;
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }

    input, select, textarea {
      width: 100%;
      padding: 0.75rem;
      margin-top: 0.5rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #b30000;
      color: white;
      padding: 0.75rem 2rem;
      border: none;
      border-radius: 8px;
      margin-top: 1.5rem;
      font-size: 1rem;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #990000;
    }

    footer {
      text-align: center;
      padding: 1rem;
      color: #777;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <header>Pesan Ramen Sekarang!</header>

  <div class="order-container">
    <h2>Formulir Pemesanan</h2>
    <form action="#" method="post">
      <label for="nama">Nama Lengkap</label>
      <input type="text" id="nama" name="nama" required />

      <label for="ramen">Pilih Menu Ramen</label>
      <select id="ramen" name="ramen" required>
        <option value="">-- Pilih Ramen --</option>
        <option value="ramen-pedas">Ramen Pedas Level 5</option>
        <option value="ramen-sapi">Ramen Kuah Kaldu Sapi</option>
        <option value="ramen-ayam">Ramen Ayam Klasik</option>
      </select>

      <label for="jumlah">Jumlah Porsi</label>
      <input type="number" id="jumlah" name="jumlah" min="1" value="1" required />

      <label for="catatan">Catatan Tambahan</label>
      <textarea id="catatan" name="catatan" rows="3" placeholder="Contoh: Tanpa bawang, ekstra pedas..."></textarea>

      <button type="submit">Kirim Pesanan</button>
    </form>
  </div>

  <footer>&copy; 2025 Ramen Merah | Nikmatnya Ramen Tanpa Batas</footer>

</body>
</html>
