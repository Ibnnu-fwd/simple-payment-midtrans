@extends('layouts.app')

@section('content')
    <div class="card" style="width: 18rem;">
        <img src="{{ asset('image/contoh.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover"
            alt="semangka hati">
        <div class="card-body">
            <h5 class="card-title">
                Semangka Hati
            </h5>
            <p class="card-text">
                Beli benih biji semanga hati dari jepang di Seedstore. Promo khusus pengguna baru di aplikasi Tokopedia!
            </p>
            <div class="mb-3">
                <label for="qty" class="form-label">Mau pesan berapa</label>
                <input type="number" name="qty" class="form-control" id="qty" value="{{ $order->qty }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Pelanggan</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $order->name }}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Nomer Telepon</label>
                <input type="text" name="phone" class="form-control" id="phone" value="{{ $order->phone }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" name="address" id="address" rows="3">{{ $order->address }}</textarea>
            </div>
            <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
        </div>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                $('input').attr('disabled', true);
                $('textarea').attr('disabled', true);
            });
        </script>

        <script type="text/javascript">
            // For example trigger on button clicked, or any time you need
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function() {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        /* You may add your own implementation here */
                        alert("payment success!");
                        console.log(result);
                    },
                    onPending: function(result) {
                        /* You may add your own implementation here */
                        alert("wating your payment!");
                        console.log(result);
                    },
                    onError: function(result) {
                        /* You may add your own implementation here */
                        alert("payment failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                })
            });
        </script>
    @endpush
@endsection
