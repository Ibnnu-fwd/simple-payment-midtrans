@extends('layouts.app')

@section('content')
    <div class="card" style="width: 18rem;">
        <img src="{{ asset('image/contoh.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover" alt="semangka hati">
        <div class="card-body">
            <h5 class="card-title">
                Semangka Hati
            </h5>
            <p class="card-text">
                Beli benih biji semanga hati dari jepang di Seedstore. Promo khusus pengguna baru di aplikasi Tokopedia!
            </p>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="qty" class="form-label">Mau pesan berapa</label>
                    <input type="number" name="qty" class="form-control" id="qty">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomer Telepon</label>
                    <input type="text" name="phone" class="form-control" id="phone">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
    </div>
@endsection
