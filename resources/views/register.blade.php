<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, dll. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet">
</head>
<body class="login">
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <img src="{{ asset('assets/Logo.png') }}" alt="logo" height="100px" width="auto">
                    
                    <p style="font-size: 20px">Register</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}" required />
                        </div>

                        <div class="mt-2">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required />
                        </div>

                        <div class="mt-2">
                            <input type="password" class="form-control" placeholder="Password" name="password" required />
                        </div>

                        <div class="mt-2">
                            <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation" required />
                        </div>

                        <div class="mt-2">
                            <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}" required />
                        </div>

                        <div class="mt-2">
                            <input type="text" class="form-control" placeholder="No. HP" name="no_hp" value="{{ old('no_hp') }}" required />
                        </div>

                        <div class="mt-2">
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="mt-2">
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required />
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success btn-block">Daftar</button>
                        </div>

                        <div class="mt-2 text-center">
                            <a href="{{ route('login') }}" class="btn btn-link">Sudah punya akun? Login disini</a>
                        </div>

                        <div class="clearfix"></div>
                        <div class="separator">
                            <br />
                            <div>
                                <p>©2025 Created By Haris</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
