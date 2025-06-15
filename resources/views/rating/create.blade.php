@extends('layout.master')

@section('title', 'Input Data Rating')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Rating</h3>
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
                            <form action="/rating/store" method="post" novalidate>
                                @csrf
                                <span class="section">Input Data Rating</span>

                                <!-- Pilih User -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">User<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="user_id" class="form-control" required>
                                            <option value="">Pilih User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Pilih Menu -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Menu<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="menu_id" class="form-control" required>
                                            <option value="">Pilih Menu</option>
                                            @foreach ($menus as $menu)
                                                <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Nilai Rating -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Nilai Rating<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="number" id="nilai" name="nilai" class="form-control"
                                            step="0.5" min="1" max="5"
                                            placeholder="Masukkan nilai rating (1 - 5)" required
                                            value="{{ old('nilai') }}">
                                        <small id="error-nilai" style="color:red; display:none;">Nilai harus antara 1 sampai
                                            5</small>

                                        @error('nilai')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>



                                <!-- Komentar -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Komentar<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <textarea name="komentar" class="form-control" required></textarea>
                                    </div>
                                </div>

                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="/rating" class="btn btn-danger">Batal</a>
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

    <!-- Tambahkan script -->
    <script>
        const inputNilai = document.getElementById('nilai');
        const errorNilai = document.getElementById('error-nilai');

        inputNilai.addEventListener('input', function() {
            if (this.value < 1 || this.value > 5) {
                errorNilai.style.display = 'block';
            } else {
                errorNilai.style.display = 'none';
            }
        });
    </script>

@endsection
