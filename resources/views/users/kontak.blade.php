<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kontak Kami</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }

        .contact-container {
            max-width: 600px;
            margin: 60px auto;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            resize: vertical;
        }

        form button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h2>Kontak Kami</h2>
        <form method="POST" action="/kirim-pesan">
            @csrf
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Alamat Email</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Pesan</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit">Kirim Pesan</button>
        </form>
    </div>
</body>
</html>
