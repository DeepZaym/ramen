@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Menu</h2>

    <form method="POST" action="{{ route('menu.update', $menu->menu_id) }}">
        @csrf
        @method('PUT')

        <label>Nama Menu:</label>
        <input type="text" name="menu_nama" class="form-control" value="{{ $menu->menu_nama }}" required><br>

        <label>Deskripsi:</label>
        <textarea name="menu_deskripsi" class="form-control">{{ $menu->menu_deskripsi }}</textarea><br>

        <label>Harga:</label>
        <input type="number" name="menu_harga" class="form-control" value="{{ $menu->menu_harga }}" required><br>

        <label>Stok:</label>
        <input type="number" name="stok" class="form-control" value="{{ $menu->stok }}" required><br>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
