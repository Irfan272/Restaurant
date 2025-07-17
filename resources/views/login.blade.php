<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, dll. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="login">
    <div>

        {{-- @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif --}}

        {{-- Alert Success dari session --}}


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

                    <p style="font-size: 20px">Login</p>
                    <form method="POST" action="/login" novalidate>
                        @csrf

                        <div>
                            <input type="email" class="form-control" placeholder="Masukan Email" required
                                id="email" name="email" autofocus />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input type="password" class="form-control mt-4" placeholder="Password" id="password"
                                name="password" required />
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <!-- Tambahkan tombol register -->
                            <div class="mt-2 text-center">
                                <a href="{{ route('register') }}" class="btn btn-link">Belum punya akun? Daftar
                                    disini</a>
                            </div>

                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <p>©2025 Created By Muhammad Arif Hidayat</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    {{-- SweetAlert for success --}}
    @if (session('success') && session('redirect_to'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                text: 'Anda akan diarahkan...',
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true
            }).then(() => {
                window.location.href = "{{ session('redirect_to') }}";
            });
        </script>
    @endif

    {{-- SweetAlert for error --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Login',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
</body>


</html>
