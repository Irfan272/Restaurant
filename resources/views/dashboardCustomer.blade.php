@extends('layout.master')

@section('title', 'Company Profile')

@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Tentang Kami</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Profil Kedai</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div class="row">
              <div class="col-md-5">
                <img src="{{ asset('assets/Logo.png') }}" class="img-fluid" alt="Kedai Makanan" style="width:100%; border-radius:10px;">
              </div>
              <div class="col-md-7">
                <h2>KEDAI GEPREK BANGBRE</h2>
                <p><strong>KEDAI GEPREK BANGBRE</strong> adalah penyedia hidangan ayam geprek khas Indonesia dengan cita rasa pedas yang mantap dan sambal pilihan yang menggugah selera. Sejak 2020, kami hadir untuk memenuhi selera para pecinta pedas dengan racikan rasa autentik yang dipadukan dengan sentuhan modern.</p>
                
                <p>Kami menggunakan bahan-bahan segar berkualitas dan sambal yang diracik langsung oleh tim dapur berpengalaman. Setiap menu diolah dengan penuh perhatian agar selalu memberikan kepuasan dalam setiap gigitan.</p>
              </div>
            </div>

            <hr>

            <div class="row mt-4">
              <div class="col-md-6">
                <h4>Visi</h4>
                <p>Menjadi kedai ayam geprek favorit masyarakat Indonesia yang dikenal karena kualitas rasa, pelayanan, dan harga terjangkau.</p>
              </div>
              <div class="col-md-6">
                <h4>Misi</h4>
                <ul>
                  <li>Menyajikan ayam geprek dengan kualitas terbaik dan sambal khas BangBre.</li>
                  <li>Mengutamakan kepuasan pelanggan dengan pelayanan cepat dan ramah.</li>
                  <li>Membuka peluang kemitraan di berbagai wilayah Indonesia.</li>
                </ul>
              </div>
            </div>

            <hr>

            <div class="row mt-4">
              <div class="col-md-12">
                <h4>Alamat Kedai</h4>
                <p><i class="fa fa-map-marker"></i>  Jalan km Idris benggala Neglasari gang manggis 3 RT 002/013 kota serang banten </p>
                <p><i class="fa fa-phone"></i>  0895339228427</p>
                <p><i class="fa fa-instagram"></i> @ayamgeprekbangbre_</p>
              </div>
            </div>

          </div> <!-- x_content -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
