@extends('layout.master')

@section('title', 'Data Rating Menu')

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="top_tiles">
      <h1>Data Rating Menu</h1>
    </div>

    <div class="col-md-12 col-sm-12">
      {{-- <a href="/rating/create" class="btn btn-success pull-right">
        <i class="fa fa-plus"></i> Tambah Rating
      </a> --}}
      <div class="x_panel">
        <div class="x_title">
          @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <h2>Tabel Data <small>Rating Menu</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">

                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Customer</th>
                      <th>Menu</th>
                      <th>Rating</th>
                      <th>Komentar</th>
                      {{-- <th style="width: 20%">Action</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($rating as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->User->name ?? '-' }}</td>
                      <td>{{ $item->Menu->nama_menu ?? '-' }}</td>
                      <td>{{ $item->nilai }}</td>
                      <td>{{ $item->komentar }}</td>
                      {{-- <td>
                        <a href="/rating/edit/{{ $item->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                        <form action="/rating/delete/{{ $item->id }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </button>
                        </form> --}}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection
