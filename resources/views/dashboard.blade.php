@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="right_col" role="main">
        <div class="col-lg-12">
            <div class="top_tiles">
                <h1 class="text-center mb-4">Selamat Datang Di <strong>E-KASIR</strong></h1>
                <div class="row justify-content-center">

                    <!-- Pesanan Selesai -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #28a745; border-radius: 10px;">
                            <div>
                                <h5>Pesanan Selesai</h5>
                                <h3 class="text-white">{{ $totalCompleted }}</h3>
                            </div>
                            <i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i>
                        </div>
                    </div>

                    <!-- Pesanan Proses -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #ffc107; border-radius: 10px;">
                            <div>
                                <h5>Pesanan Proses</h5>
                                <h3 class="text-white">{{ $totalProcessing }}</h3>
                            </div>
                            <i class="fa fa-hourglass-half fa-2x"></i>
                        </div>
                    </div>

                    <!-- Pesanan Baru -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #17a2b8; border-radius: 10px;">
                            <div>
                                <h5>Pesanan Baru</h5>
                                <h3 class="text-white">{{ $totalPending }}</h3>
                            </div>
                            <i class="fa fa-plus-circle fa-2x"></i>
                        </div>
                    </div>

                    <!-- Pesanan Batal -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #dc3545; border-radius: 10px;">
                            <div>
                                <h5>Pesanan Batal</h5>
                                <h3 class="text-white">{{ $totalCancelled }}</h3>
                            </div>
                            <i class="fa fa-times-circle fa-2x"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
