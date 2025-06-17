@extends('layout.master')

@section('title', 'Data Customer')

@section('content')
    
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="top_tiles">
            <h1>Data Customer </h1>
          </div>

          <div class="col-md-12 col-sm-12 ">
              {{-- <a href="/akun/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data
                  Akun</a> --}}
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
                  <h2>Tabel Data <small>Customer</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="card-box table-responsive">
              
                  <table id="datatable" class="table table-striped table-bordered " style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        {{-- <th>NIK</th> --}}
                        <th>Nama Akun</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Email</th>
                        <th>Role</th>
             
               
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($akun as $sm)
                          
                      <tr >
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $sm->nik }}</td> --}}
                        <td>{{ $sm->name }}</td>
                        <td>{{ $sm->detailUser->alamat }}</td>
                        <td>{{ $sm->detailUser->no_hp }}</td>
                        <td>{{ $sm->detailUser->jenis_kelamin }}</td>
                        <td>{{ $sm->detailUser->tanggal_lahir }}</td>
                        
                        <td>{{ $sm->email }}</td>
                        <td>{{ $sm->role }}</td>
                       
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