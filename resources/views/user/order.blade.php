@extends('user.layout')

@section('content')
<div class="container">
    <h1>Pesan menu</h1>
    <form action="{{ route('order.submit') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="menu_id" class="form-label">Pilih Menu</label>
            <select class="form-control" name="menu_id">
                @foreach(App\Models\menu::all() as $menu)
                    <option value="{{ $menu->menu_id }}">{{ $menu->menu_nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
        </div>

        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
    </form>
</div>
@endsection
