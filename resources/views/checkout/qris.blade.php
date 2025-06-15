@extends('layout.master')

@section('title', 'QRIS Payment')

@section('content')
<div class="container mt-5">
    <h3>Scan QRIS untuk Membayar</h3>
    <div id="snap-container"></div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            alert("Pembayaran berhasil!");
            window.location.href = "/checkout/success";
        },
        onPending: function(result) {
            alert("Menunggu pembayaran...");
        },
        onError: function(result) {
            alert("Pembayaran gagal.");
        },
        onClose: function() {
            alert("Anda menutup pembayaran.");
        }
    });
</script>
@endpush
