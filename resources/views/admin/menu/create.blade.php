@extends('layouts.app')

@section('content')
<h2>Tambah Menu</h2>

<form method="POST" action="{{ route('menu.store') }}">
    @csrf

    <label>Nama Menu:</label><br>
    <input type="text" name="menu_nama" required><br>

    <label>Deskripsi:</label><br>
    <textarea name="menu_deskripsi"></textarea><br>

    <label>Harga:</label><br>
    <input type="number" name="menu_harga" step="0.01" required><br>

    <label>Stok:</label><br>
    <input type="number" name="stok" min="0" required><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
