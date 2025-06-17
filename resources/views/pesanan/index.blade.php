@extends('layout.master')

@section('title', 'Data Pesanan')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="top_tiles">
                <h1>Data Pesanan</h1>
            </div>

            <div class="col-md-12 col-sm-12 ">
                {{-- <a href="/pesanan/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Pesanan</a> --}}
                <div class="x_panel">
                    <div class="x_title">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h2>Tabel Data <small>Pesanan</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Customer</th>
                                                @if (Auth::guard('user')->user()->role === 'Pelayan')
                                                    <th>Alamat</th>
                                                    <th>Customer</th>
                                                @endif
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>Jenis Pesanan</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                @if (Auth::guard('user')->user()->role != 'Pelayan')
                                                    <th>Metode Pembayaran</th>
                                                    <th>Uang Diterima</th>
                                                @endif
                                                <th>Catatan</th>
                                                <th style="width: 20%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($pesanans as $pesanan)
                                                @php
                                                    switch ($pesanan->status) {
                                                        case 'Pending':
                                                            $rowClass = 'table-warning';
                                                            break;
                                                        case 'Processing':
                                                            $rowClass = 'table-primary';
                                                            break;
                                                        case 'Completed':
                                                            $rowClass = 'table-success';
                                                            break;
                                                        case 'Cancelled':
                                                            $rowClass = 'table-danger';
                                                            break;
                                                        case 'Delivered':
                                                            $rowClass = 'table-info'; // Warna biru muda
                                                            break;
                                                        default:
                                                            $rowClass = '';
                                                    }
                                                @endphp


                                                <tr class="{{ $rowClass }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pesanan->user->name }}</td>
                                                    @if (Auth::guard('user')->user()->role === 'Pelayan')
                                                        <td>{{ $pesanan->user->detailUser->alamat }}</td>
                                                        <td>{{ $pesanan->user->detailUser->no_hp }}</td>
                                                    @endif
                                                    <td>{{ $pesanan->tanggal_pesanan }}</td>
                                                    <td>{{ $pesanan->waktu_pesanan }}</td>
                                                    <td>{{ $pesanan->jenis_pesanan }}</td>

                                                    <td>
                                                        <span class="badge badge-light">{{ $pesanan->status }}</span>
                                                    </td>

                                                    <td>Rp {{ number_format($pesanan->total_pesanan, 0, ',', '.') }}</td>
                                                    @if (Auth::guard('user')->user()->role != 'Pelayan')
                                                        <td>{{ $pesanan->metode_pembayaran }}</td>
                                                        <td>Rp {{ number_format($pesanan->uang_diterima, 0, ',', '.') }}
                                                        </td>
                                                    @endif

                                                    <td>{{ $pesanan->catatan }}</td>

                                                    <td style="text-align: left">
                                                        <a href="/pesanan/view/{{ $pesanan->id }}"
                                                            class="btn btn-info btn-xs">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        @if (Auth::guard('user')->user()->role != 'Customer')
                                                            <a href="/pesanan/edit/{{ $pesanan->id }}"
                                                                class="btn btn-warning btn-xs">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('pesanan.cetak', $pesanan->id) }}"
                                                            class="btn btn-primary" target="_blank">
                                                            <i class="fa fa-download"></i>
                                                        </a>

                                                    </td>
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
        </div>
    </div>

@endsection
