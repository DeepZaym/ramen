@extends('user.layout')

@section('content')
<div class="container">
    <h1>Pesan Ramen</h1>
    <form action="{{ route('order.submit') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="ramen_id" class="form-label">Pilih Ramen</label>
            <select class="form-control" name="ramen_id">
                @foreach(App\Models\Ramen::all() as $ramen)
                    <option value="{{ $ramen->ramen_id }}">{{ $ramen->ramen_nama }}</option>
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
