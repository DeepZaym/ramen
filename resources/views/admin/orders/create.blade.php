@extends('layouts.app')

@section('content')
<h2>Tambah Pesanan</h2>
<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <label>User</label>
    <select name="users_id" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <label>Alamat Pengiriman</label>
    <input type="text" name="delivery_address" required>

    <h4>Pilih Menu</h4>
    <div id="menu-items">
        <div>
            <select name="items[0][menu_id]" required>
                @foreach($menu as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} (Rp{{ $item->harga }})</option>
                @endforeach
            </select>
            <input type="number" name="items[0][quantity]" min="1" placeholder="Jumlah" required>
        </div>
    </div>

    <button type="button" onclick="addItem()">Tambah Item</button>
    <button type="submit">Simpan</button>
</form>

<script>
let itemIndex = 1;
function addItem() {
    const container = document.getElementById('menu-items');
    const html = `
        <div>
            <select name="items[${itemIndex}][menu_id]" required>
                @foreach($menu as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->nama }} (Rp{{ $menu->harga }})</option>
                @endforeach
            </select>
            <input type="number" name="items[${itemIndex}][quantity]" min="1" placeholder="Jumlah" required>
        </div>`;
    container.insertAdjacentHTML('beforeend', html);
    itemIndex++;
}
</script>
@endsection
