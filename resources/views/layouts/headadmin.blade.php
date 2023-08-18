<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Booking</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('admintheme/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('admintheme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('admintheme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('admintheme/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ url('admintheme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('admintheme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('admintheme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admintheme/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('admintheme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('admintheme/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('admintheme/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- jQuery -->
<script src="{{ url('admintheme/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('admintheme/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ url('storage/logos/logo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="{{ url('admin/listtransaksi/pesan') }}">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge" id="transaksi"></span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="{{ url('admin/reservasi') }}">
          <i class="far fa-envelope"></i>
          <span class="badge badge-danger navbar-badge" id="reservasi"></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{ route('logout') }}" class="dropdown-item"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url('storage/logos/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Booking</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Tentang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/about/1/edit') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tentang Book.ing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/tim') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tim</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/qrmeja') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/slider') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slider Photo</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/katalog') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Katalog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/menukategori') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/menu') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/katalog') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Reservasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/reservasi') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reservasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/listreservasi/setuju') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setuju</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/listreservasi/selesai') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Selesai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/listreservasi/ditolak') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ditolak</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/keperluan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keperluan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/jadwal') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/katalog') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/listtransaksi/pesan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pemesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/listtransaksi/diproses') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diproses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/listtransaksi/selesai') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Selesai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/laporan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/selesai') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Monolog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/monologkategori') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/monolog') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monolog</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/dialog') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Dialog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/kajian') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kajian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/agenda') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agenda</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/user') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Booking Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="https">Retno Vega Astuti</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('admintheme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('admintheme/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('admintheme/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ url('admintheme/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('admintheme/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('admintheme/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('admintheme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('admintheme/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('admintheme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ url('admintheme/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('admintheme/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('admintheme/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('admintheme/dist/js/adminlte.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<!-- <script src="{{ url('admintheme/dist/js/ckeditor.js') }}"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="{{ url('admintheme/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('admintheme/dist/js/pages/dashboard.js') }}"></script>

<script>
  $(function(){
    var datatransaksi = 0;
    var datareservasi = 0;
  setInterval(notifikasi, 1000);//fungsi yang dijalan setiap detik, 1000 = 1 detik

});
CKEDITOR.replace( 'deskripsi' );

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  //message with toastr
  @if(session()->has('success'))

      toastr.success('{{ session('success') }}', 'BERHASIL!');

  @elseif(session()->has('error'))

      toastr.error('{{ session('error') }}', 'GAGAL!');

  @endif
  function notifikasi() {
  $.ajax({
    type  : 'ajax',
    url   : '{{ url('admin/counttransaksi') }}',
    async : false,
    type : 'GET',
    dataType : 'json',
    data : {"id":"1"},
    success: function(data) {
      // alert(data.transaksis);
      $('#transaksi').html(data.transaksis);
      $('#reservasi').html(data.reservasis);
    datatransaksi = data.transaksis;
    datareservasi = data.reservasis;
    },
  });
}
</script>
</body>
</html>
