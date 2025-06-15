@extends('layout.master')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="right_col" role="main">
    <div class="container">

        <div class="page-title">
            <div class="title_left">
                <h3>Keranjang Belanja</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Daftar Pesanan</h5>
                    <a href="{{ route('order.reset') }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Kosongkan Keranjang
                    </a>
                </div>

                @if(count($keranjang) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($keranjang as $item)
                                @php 
                                    $total = $item['harga'] * $item['jumlah']; 
                                    $grandTotal += $total; 
                                @endphp
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-start">{{ $item['nama'] }}</td>
                                    <td>Rp {{ number_format($item['harga'],0,',','.') }}</td>
                                    <td>{{ $item['jumlah'] }}</td>
                                    <td>Rp {{ number_format($total,0,',','.') }}</td>
                                    <td>
                                        <a href="{{ route('order.hapus', $item['id']) }}" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin hapus item ini?')">
                                           <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="table-info fw-bold text-center">
                                <td colspan="4">Grand Total</td>
                                <td colspan="2">Rp {{ number_format($grandTotal,0,',','.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('checkout') }}" class="btn btn-success">
                        <i class="fa fa-shopping-cart"></i> Lanjutkan ke Pembayaran
                    </a>
                </div>

                @else
                    <div class="alert alert-warning text-center m-0">
                        <i class="fa fa-info-circle"></i> Keranjang masih kosong.
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
