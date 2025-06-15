@extends('layout.master')

@section('title', 'Input Data Menu')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Menu</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                           @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="x_content">
                            <form class="" action="/list-menu/store" method="post" enctype="multipart/form-data"
                                novalidate>
                                @csrf
                                <span class="section">Input Data Menu</span>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Foto Menu<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="file" name="foto_menu"
                                            class="form-control @error('foto_menu') parsley-error @enderror" required>
                                        @error('foto_menu')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Menu<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" name="nama_menu" value="{{ old('nama_menu') }}"
                                            class="form-control @error('nama_menu') parsley-error @enderror" required>
                                        @error('nama_menu')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Harga<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" id="harga" name="harga" value="{{ old('harga') }}"
                                            class="form-control @error('harga') parsley-error @enderror" required>
                                        @error('harga')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <textarea name="deskripsi" class="form-control @error('deskripsi') parsley-error @enderror" required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Status<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="status" class="form-control @error('status') parsley-error @enderror"
                                            required>
                                            <option value="">Pilih Status</option>
                                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="Tidak Aktif"
                                                {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Kategori<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="category_id"
                                            class="form-control @error('category_id') parsley-error @enderror" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->nama_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="/menu" class="btn btn-danger">Batal</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const hargaInput = document.getElementById('harga');

        hargaInput.addEventListener('input', function(e) {
            let value = this.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            this.value = rupiah ? 'Rp ' + rupiah : '';
        });

        // Saat submit form, hapus format rupiah
        document.querySelector('form').addEventListener('submit', function(e) {
            hargaInput.value = hargaInput.value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection
