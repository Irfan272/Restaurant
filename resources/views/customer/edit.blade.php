@extends('layout.master')

@section('title', 'Edit Data Akun')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Akun</h3>
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
                            <form class="" enctype="multipart/form-data" action="/customer/update/{{ $akun->id }}" method="post" novalidate>
                                @csrf
                                @method('PATCH')

                                <span class="section">Edit Data Akun</span>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Username<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" value="{{ old('name', $akun->name) }}"
                                            class="@error('name') parsley-error @enderror form-control" name="name" required />
                                        @error('name')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="email" value="{{ old('email', $akun->email) }}"
                                            class="@error('email') parsley-error @enderror form-control" name="email" required />
                                        @error('email')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="password"
                                            class="@error('password') parsley-error @enderror form-control" name="password" required />
                                        @error('password')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                        

                                {{-- Detail User --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" name="alamat" class="form-control"
                                            value="{{ old('alamat', $akun->detailUser->alamat ?? '') }}">
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">No HP</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" name="no_hp" class="form-control"
                                            value="{{ old('no_hp', $akun->detailUser->no_hp ?? '') }}">
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $akun->detailUser->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $akun->detailUser->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="date" name="tanggal_lahir" class="form-control"
                                            value="{{ old('tanggal_lahir', $akun->detailUser->tanggal_lahir ?? '') }}">
                                    </div>
                                </div>

                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' class="btn btn-primary">Submit</button>
                                            <a href="/makanan" class="btn btn-danger">Batal</a>
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
@endsection
