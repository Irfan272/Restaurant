@extends('layout.master')

@section('title', 'Detail Makanan')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Makanan :: {{ $menu->nama_menu }}</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Makanan :: {{ $menu->nama_menu }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $menu->foto_menu) }}" alt="{{ $menu->nama_menu }}" />
                            </div>
                        </div>

                        <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                            <h3 class="prod_title">{{ $menu->nama_menu }}</h3>
                            <p>{{ $menu->deskripsi }}</p>

                            <!-- Rating -->
                            <div class="mb-2">
                                <div class="d-flex justify-content-start align-items-center gap-1"
                                    style="font-size: 20px; color: #ffc107;">
                                    @php
                                        $rating = round($menu->rating_avg_nilai, 1);
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

                                    <span class="text-muted ms-2" style="font-size: 18px;">{{ $rating }} / 5</span>
                                </div>
                            </div>

                            <div class="product_price">
                                <h1 class="price">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</h1>
                                <br>
                            </div>

                            <!-- Input jumlah -->
                            <div class="mb-3">
                                <label>Jumlah Pesanan:</label>
                                <input type="number" id="jumlah" class="form-control" value="1" min="1"
                                    style="width: 100px;">
                            </div>

                            <div class="">
                                <a href="javascript:void(0);" class="btn btn-success btn-lg tambah-ke-keranjang"
                                    data-id="{{ $menu->id }}">
                                    <i class="fa fa-cart-plus"></i> Tambah Pesanan
                                </a>
                            </div>
                        </div>

                        <!-- Komentar -->
                        <div class="col-md-12 mt-4">
                            <div role="tabpanel">
                                <ul class="nav nav-tabs bar_tabs">
                                    <li role="presentation" class="active"><a href="#tab_content1"
                                            data-toggle="tab">Komentar</a></li>
                                </ul>

                                <!-- Tombol Tambah Komentar -->
                                <div class="text-right mt-3 mb-3">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahKomentar">
                                        <i class="fa fa-plus"></i> Tambah Komentar
                                    </button>
                                </div>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1">
                                        <ul class="messages">
                                            @forelse ($menu->rating as $review)
                                                <li class="d-flex" style="margin-bottom: 15px;">
                                                    <div class="d-flex flex-column align-items-center me-3" style="width: 60px;">
                                                        <img src="{{ asset('assets/images/2.jpg') }}" class="avatar" alt="Avatar" style="width:50px;height:50px;">
                                                        <div class="message_date text-center mt-1">
                                                            <h4 class="date text-info" style="margin: 0;">{{ $review->created_at->format('d') }}</h4>
                                                            <small class="month">{{ $review->created_at->format('M') }}</small>
                                                        </div>
                                                    </div>

                                                    <div class="message_wrapper flex-fill">
                                                        <h4 class="heading mb-1">{{ $review->user->name ?? 'Anonymous' }}</h4>

                                                        <div class="d-flex align-items-center mb-2" style="color: #ffc107; font-size: 16px;">
                                                            @php
                                                                $userRating = $review->nilai;
                                                                $fullStars = floor($userRating);
                                                                $halfStar = $userRating - $fullStars >= 0.5 ? 1 : 0;
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

                                                            <span class="ms-2 text-muted" style="font-size: 14px;">{{ number_format($userRating, 1) }} / 5</span>
                                                        </div>

                                                        <blockquote class="message">{{ $review->komentar }}</blockquote>
                                                    </div>
                                                </li>
                                            @empty
                                                <li>Belum ada komentar.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End Komentar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Komentar -->
<div class="modal fade" id="modalTambahKomentar" tabindex="-1" role="dialog" aria-labelledby="modalTambahKomentarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/rating/store" method="post" novalidate>
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahKomentarLabel">Tambah Komentar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Menu otomatis -->
          <input type="hidden" name="menu_id" value="{{ $menu->id }}">

          <!-- Nilai Rating -->
          <div class="form-group">
            <label>Nilai Rating (1-5)</label>
            <input type="number" name="nilai" class="form-control" step="0.5" min="1" max="5" required>
          </div>

          <!-- Komentar -->
          <div class="form-group">
            <label>Komentar</label>
            <textarea name="komentar" class="form-control" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
