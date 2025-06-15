@extends('layout.master')

@section('title', 'Detail Makanan')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Menu Makanan</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Pilihan Menu</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- BEST SELLER -->
                        <h1 class="mb-3">Best Seller</h1>
                        <div class="row g-4">
                            @foreach ($menuBest as $item)
                                <div class="col-md-3 d-flex mb-3">
                                    <div class="card shadow-sm flex-fill d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="height: 140px; background-color: #f9f9f9;">
                                            <img src="{{ asset('storage/' . $item->foto_menu) }}"
                                                alt="{{ $item->nama_menu }}"
                                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body text-center p-2 d-flex flex-column justify-content-between flex-grow-1">
                                            <div>
                                                <h6 class="card-title mb-1" style="border-bottom: 1px solid #ccc;">
                                                    {{ $item->nama_menu }}</h6>
                                                <p class="mb-2 text-muted" style="font-size: 14px;">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>

                                                <!-- Rating -->
                                                <div class="mb-2">
                                                    <div class="d-flex justify-content-center align-items-center gap-1" style="font-size: 14px; color: #ffc107;">
                                                        @php
                                                            $rating = round($item->rating_avg_nilai, 1);
                                                            $fullStars = floor($rating);
                                                            $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                                                            $emptyStars = 5 - $fullStars - $halfStar;
                                                        @endphp
                                                        @for ($i = 0; $i < $fullStars; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                        @if ($halfStar)
                                                            <i class="fa fa-star-half-o"></i>
                                                        @endif
                                                        @for ($i = 0; $i < $emptyStars; $i++)
                                                            <i class="fa fa-star-o"></i>
                                                        @endfor
                                                        <span class="text-muted ms-2" style="font-size: 13px;">{{ $rating }} / 5</span>
                                                    </div>
                                                </div>

                                                <div class="mb-2">
                                                    <input type="number"
                                                        class="form-control form-control-sm text-center jumlah-input"
                                                        value="1" min="1"
                                                        style="width: 60px; margin: 0 auto;">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="/makanan/detail/{{ $item->id }}" class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-outline-success btn-sm tambah-ke-keranjang"
                                                    data-id="{{ $item->id }}" title="Tambah Pesanan">
                                                    <i class="fa fa-cart-plus"></i> 
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-5">

                        <!-- MENU LAINNYA -->
                        <h1>Menu Lainnya</h1>
                        <div class="row g-4">
                            @foreach ($menu as $item)
                                <div class="col-md-3 d-flex mb-3">
                                    <div class="card shadow-sm flex-fill d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="height: 140px; background-color: #f9f9f9;">
                                            <img src="{{ asset('storage/' . $item->foto_menu) }}"
                                                alt="{{ $item->nama_menu }}"
                                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body text-center p-2 d-flex flex-column justify-content-between flex-grow-1">
                                            <div>
                                                <h6 class="card-title mb-1" style="border-bottom: 1px solid #ccc;">
                                                    {{ $item->nama_menu }}</h6>
                                                <p class="mb-2 text-muted" style="font-size: 14px;">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>

                                                <div class="mb-2">
                                                    <div class="d-flex justify-content-center align-items-center gap-1" style="font-size: 14px; color: #ffc107;">
                                                        @php
                                                            $rating = round($item->rating_avg_nilai, 1);
                                                            $fullStars = floor($rating);
                                                            $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                                                            $emptyStars = 5 - $fullStars - $halfStar;
                                                        @endphp
                                                        @for ($i = 0; $i < $fullStars; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                        @if ($halfStar)
                                                            <i class="fa fa-star-half-o"></i>
                                                        @endif
                                                        @for ($i = 0; $i < $emptyStars; $i++)
                                                            <i class="fa fa-star-o"></i>
                                                        @endfor
                                                        <span class="text-muted ms-2" style="font-size: 13px;">{{ $rating }} / 5</span>
                                                    </div>
                                                </div>

                                                <div class="mb-2">
                                                    <input type="number"
                                                        class="form-control form-control-sm text-center jumlah-input"
                                                        value="1" min="1"
                                                        style="width: 60px; margin: 0 auto;">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="/makanan/detail/{{ $item->id }}" class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-outline-success btn-sm tambah-ke-keranjang"
                                                    data-id="{{ $item->id }}" title="Tambah Pesanan">
                                                    <i class="fa fa-cart-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection