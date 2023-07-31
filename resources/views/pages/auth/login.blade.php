<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absensi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

    <div class="mx-auto mb-4 d-block justify-content-center text-center">
        <small class="h5 text-bold">Absensi</small>
        <p class="h3">MTsN 27 JAKARTA</p>
    </div>

    <div class="login-box mt-2">

        @if (session()->has('info'))
            <div class="alert alert-yellow alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6 class="text-bold"><i class="icon fas fa-exclamation-circle"></i> Perhatian!</h6>
                {{ session('info') }}
            </div>
        @endif

        <form action="/login" method="post">
            @csrf
            <label for="username">Username</label>
            <div class="input-group mb-4">
                <input type="text" value="{{ old('username') }}" name="username" id="username" class="form-control" placeholder="Masukkan username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <label for="password">Password</label>
            <div class="input-group mb-4">
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-black rounded btn-block">Sign in to account</button>
                </div>
            </div>
        </form>

    </div>

    <!-- jQuery -->
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.min.js"></script>

</body>
</html>
