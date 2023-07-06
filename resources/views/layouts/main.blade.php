@php

    use App\Models\User;
    use Carbon\Carbon;
    use Carbon\CarbonInterface;

    $admin = Auth::user()->admin;
    $guru = Auth::user()->guru;
    $siswa = Auth::user()->siswa;


    if ($admin) {
        $userLogin = $admin;
    } elseif ($guru) {
        $userLogin = $guru;
    } elseif ($siswa) {
        $userLogin = $siswa;
    }

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Absensi MA Sumber Payung
    </title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/adminlte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    {{-- my css --}}
    <link rel="stylesheet" href="/my-css/style.css">

    <link href="/extensions/simple-datatables/style.css" rel="stylesheet">
    <link href="/extensions/simple-datatables.css" rel="stylesheet">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@200;500;700&family=Poppins:wght@300;400;500;700;800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap');
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed" style="font-family: 'Figtree';">
    <div class="wrapper">

        <!-- Navbar -->
        @include('partials.navbar')

        <!-- /.navbar -->

        @include('partials.sidebar2')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        @include('partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <div class="modal fade" id="modal-logout">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title poppins fw-bold">Konfirmasi Logout</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="my-0">Apakah anda yakin akan keluar dari Aplikasi Absensi?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/my-js/popper.js"></script>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="modal"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    </script>
    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    </script>
    <script>
      $(function () {
          $('[data-toggle="tooltip"]').tooltip();
      });
  </script>

    <script>
      var toastElList = [].slice.call(document.querySelectorAll('.toast'))
      var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, option)
      })
    </script>


    <script>
      $('#updateProfil').toast('show')
    </script>
    {{-- <!-- ChartJS -->
    <script src="/adminlte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/adminlte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}
    {{-- <!-- jQuery Knob Chart -->
    <script src="/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/adminlte/plugins/moment/moment.min.js"></script>
    <script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote --> --}}
    {{-- <script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App --> --}}
    <script src="/adminlte/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="/adminlte/dist/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/adminlte/dist/js/pages/dashboard.js"></script>
    <script src="/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="/extensions/simple-datatables.js"></script>



</body>

</html>
