@extends('layout.master')

@section('title', 'Edit Data Category')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Category</h3>
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
                            @foreach ($category as $c)
                                <form action="/category/update/{{ $c->id }}" method="post" novalidate>
                                    @csrf
                                    @method('PATCH')

                                    <span class="section">Edit Data Category</span>

                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">
                                            Nama Category<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" value="{{ old('nama_category', $c->nama_category) }}"
                                                class="@error('nama_category') parsley-error @enderror form-control"
                                                name="nama_category" required />
                                            @error('nama_category')
                                                <ul class="parsley-errors-list filled">
                                                    <li class="parsley-required">{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">
                                            Status<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <select name="status" id="status" class="form-control selectpicker"
                                                data-live-search="true" required>
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif" {{ old('status', $c->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="Tidak Aktif" {{ old('status', $c->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="ln_solid">
                                        <div class="form-group">
                                            <div class="col-md-6 offset-md-3">
                                                <button type='submit' class="btn btn-primary">Update</button>
                                                <a href="/category" class="btn btn-danger">Batal</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
