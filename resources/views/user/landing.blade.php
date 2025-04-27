@extends('user.layout')

@section('content')
<div class="container text-center">
    <h1>Selamat Datang di Ramen Rush</h1>
    <p>Nikmati ramen terbaik dari dapur kami!</p>
    
    <div class="row">
        @foreach($user as $user)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $user->image) }}" class="card-img-top" alt="{{ $user->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">{{ $user->description }}</p>
                        <a href="{{ route('order') }}" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection