@extends('layout.master')

@section('title', 'Detail Pesanan')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Pesanan</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form>

                            <div class="form-group">
                                <label>Customer</label>
                                <input type="text" class="form-control" value="{{ $pesanan->user->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pesanan</label>
                                <input type="text" class="form-control" value="{{ $pesanan->tanggal_pesanan }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Waktu Pesanan</label>
                                <input type="text" class="form-control" value="{{ $pesanan->waktu_pesanan }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Jenis Pesanan</label>
                                <input type="text" class="form-control" value="{{ $pesanan->jenis_pesanan }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <input type="text" class="form-control" value="{{ $pesanan->metode_pembayaran }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea class="form-control" rows="3" disabled>{{ $pesanan->catatan }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Status Pesanan</label>
                                <select class="form-control" disabled>
                                    <option value="Pending" {{ $pesanan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Processing" {{ $pesanan->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Delivered" {{ $pesanan->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Completed" {{ $pesanan->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ $pesanan->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <a href="/pesanan" class="btn btn-danger">Kembali</a>
                        </form>

                        <hr>

                        <h4>Detail Pesanan</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanan->detailPesanan as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->menu->nama_menu ?? 'Menu Tidak Ditemukan' }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>Rp {{ number_format($detail->total, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
