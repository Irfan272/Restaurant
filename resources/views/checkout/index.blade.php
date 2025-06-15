@extends('layout.master')

@section('title', 'Checkout')

@section('content')
<div class="container mt-5">
    <h3>Checkout</h3>
    <form action="/checkout/submit" method="POST">
        @csrf

        <div class="form-group">
            <label>Alamat Pengiriman:</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="form-group mt-2">
            <label>Metode Pembayaran:</label>
            <select name="metode_pembayaran" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="qris">QRIS (Midtrans)</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Catatan:</label>
            <textarea name="catatan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Bayar Sekarang</button>
    </form>
</div>
@endsection
