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
                            @foreach ($akun as $b)
                                <form class="" enctype="multipart/form-data" action="/akun/update/{{ $b->id }}"
                                    method="post" novalidate>
                                    @csrf
                                    @method('PATCH')

                                    <span class="section">Edit Data Akun</span>
                                    {{-- <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align"><span class="required">Nik*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" value="{{ $b->nik }}" class="@error('nik') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="nik" required="required" />
                                            @error('nik')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>   
                                            @enderror 
                                        </div>
                                    </div> --}}
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align"><span
                                                class="required">Username*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" value="{{ $b->name }}"
                                                class="@error('name') parsley-error @enderror form-control"
                                                data-validate-length-range="6" data-validate-words="2" name="name"
                                                required="required" />
                                            @error('name')
                                                <ul class="parsley-errors-list filled">
                                                    <li class="parsley-required">{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align"><span
                                                class="required">Nama Lengkap*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" value="{{ $b->nama_lengkap }}"
                                                class="@error('nama_lengkap') parsley-error @enderror form-control"
                                                data-validate-length-range="6" data-validate-words="2" name="nama_lengkap"
                                                required="required" />
                                            @error('nama_lengkap')
                                                <ul class="parsley-errors-list filled">
                                                    <li class="parsley-required">{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span
                                                class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="email" value="{{ $b->email }}"
                                                class="@error('email') parsley-error @enderror form-control"
                                                data-validate-length-range="6" data-validate-words="2" name="email"
                                                required="required" />
                                            @error('email')
                                                <ul class="parsley-errors-list filled">
                                                    <li class="parsley-required">{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span
                                                class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="password" value=""
                                                class="@error('password') parsley-error @enderror form-control"
                                                data-validate-length-range="6" data-validate-words="2" name="password"
                                                required="required" />
                                            @error('password')
                                                <ul class="parsley-errors-list filled">
                                                    <li class="parsley-required">{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Role<span
                                                class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="role" id="role" class="form-control selectpicker"
                                                data-live-search="true" required>
                                                <option value="" disabled
                                                    {{ old('role', $user->role ?? '') == '' ? 'selected' : '' }}>Pilih Role
                                                </option>
                                                <option value="Admin"
                                                    {{ old('role', $user->role ?? '') == 'Admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="Kasir"
                                                    {{ old('role', $user->role ?? '') == 'Kasir' ? 'selected' : '' }}>Kasir
                                                </option>
                                                {{-- <option value="Customer" {{ old('role', $user->role ?? '') == 'Customer' ? 'selected' : '' }}>Customer</option> --}}
                                                <option value="Koki"
                                                    {{ old('role', $user->role ?? '') == 'Koki' ? 'selected' : '' }}>Koki
                                                </option>
                                                <option value="Pelayan"
                                                    {{ old('role', $user->role ?? '') == 'Pelayan' ? 'selected' : '' }}>
                                                    Pelayan</option>
                                                <option value="Owner"
                                                    {{ old('role', $user->role ?? '') == 'Owner' ? 'selected' : '' }}>Owner
                                                </option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="ln_solid">
                                        <div class="form-group">
                                            <div class="col-md-6 offset-md-3">
                                                <button type='submit' class="btn btn-primary">Submit</button>
                                                <a href="/akun" class="btn btn-danger">Batal</a>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
