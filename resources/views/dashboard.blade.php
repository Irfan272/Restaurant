@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="right_col" role="main">
        <div class="col-lg-12">
            <div class="top_tiles">
                <h1 class="text-center mb-4">Selamat Datang Di <strong>
                        @if (Auth::guard('user')->user()->role == 'Admin')
                            KEDAI GEPREK BANGBRE
                        @endif
                        @if (Auth::guard('user')->user()->role == 'Koki' ||
                                Auth::guard('user')->user()->role == 'Kasir' ||
                                Auth::guard('user')->user()->role == 'Pelayan' ||
                                Auth::guard(name: 'user')->user()->role == 'Owner')
                            KEDAI GEPREK BANGBRE
                        @endif
                    </strong></h1>

                {{-- @if (Auth::guard('user')->check() && $role == 'Owner') --}}
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

            @if(Auth::guard('user')->user()->role == 'Owner')
                <div class="row mt-5">
                    <!-- Grafik Top 5 Menu Terjual -->
                    <div class="col-md-6 mb-4">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Top 5 Menu Terjual (7 Hari Terakhir)</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <canvas id="menuTerjualChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Menu Rating Tertinggi -->
                    <div class="col-md-6 mb-4">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Top 5 Menu dengan Rating Tertinggi</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <canvas id="menuRatingChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
                  {{-- @endif --}}
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Grafik Menu Terjual
            const ctx1 = document.getElementById('menuTerjualChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($menuLabels) !!},
                    datasets: [{
                        label: 'Jumlah Terjual',
                        data: {!! json_encode($menuJumlah) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Top 5 Menu Terjual'
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Grafik Menu Rating Tertinggi
            const ctx2 = document.getElementById('menuRatingChart').getContext('2d');
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($ratingLabels) !!},
                    datasets: [{
                        label: 'Rating Rata-rata',
                        data: {!! json_encode($ratingNilai) !!},
                        backgroundColor: 'rgba(255, 159, 64, 0.7)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Top 5 Menu dengan Rating Tertinggi'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5
                        }
                    }
                }
            });
        </script>
    @endsection
