@extends('layout.master')

@section('title', 'Checkout')

@section('content')
<div class="right_col" role="main">
    <div class="container">

        <div class="page-title">
            <div class="title_left">
                <h3>Checkout</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('proses.checkout') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="jenis_pesanan" class="form-label">Jenis Pesanan</label>
                        <select name="jenis_pesanan" class="form-control" required>
                            <option value="">-- Pilih Jenis Pesanan --</option>
                            <option value="Dine In">Dine In</option>
                            <option value="Take Away">Take Away</option>
                            <option value="Delivery">Delivery</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="cash">Cash</option>
                            <option value="qris">QRIS (Midtrans)</option>
                        </select>
                    </div>

                    {{-- Cash Fields --}}
                    <div id="cash-fields" style="display: none;">
                        <div class="mb-3">
                            <label for="total_belanja_cash" class="form-label">Total Belanja:</label>
                            <input type="text" class="form-control" id="total_belanja_cash" value="Rp {{ number_format($grandTotal, 0, ',', '.') }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="uang_diterima" class="form-label">Uang Diterima:</label>
                            <input type="text" class="form-control" id="uang_diterima" name="uang_diterima">
                        </div>
                        <div class="mb-3">
                            <label for="kembalian" class="form-label">Kembalian:</label>
                            <input type="text" class="form-control" id="kembalian" readonly>
                        </div>
                    </div>

                    {{-- QRIS Fields --}}
                    <div id="qris-fields" style="display: none;">
                        <div class="mb-3">
                            <label>QRIS (Scan Barcode):</label>
                            <img src="{{ asset('assets/images/dumy-qris.png') }}" alt="QRIS" class="img-fluid" style="max-width: 300px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan:</label>
                        <textarea name="catatan" id="catatan" rows="3" class="form-control"></textarea>
                    </div>

                    <h5>Rincian Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($keranjang as $item)
                                    @php $total = $item['harga'] * $item['jumlah']; @endphp
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $item['nama'] }}</td>
                                        <td>Rp {{ number_format($item['harga'],0,',','.') }}</td>
                                        <td>{{ $item['jumlah'] }}</td>
                                        <td>Rp {{ number_format($total,0,',','.') }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-info fw-bold text-center">
                                    <td colspan="4">Total</td>
                                    <td>Rp {{ number_format($grandTotal,0,',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- kirim total belanja asli ke javascript --}}
                    <input type="hidden" id="total-belanja" value="{{ $grandTotal }}">

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Proses Pesanan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


@endsection




