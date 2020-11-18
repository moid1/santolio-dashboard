<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  
  <link rel="icon" href="images/custom_images/lungwo.png" type="image/gif" sizes="16x16">

  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- DataTables -->
  <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
  <link href="assets/css/style.css" rel="stylesheet" type="text/css"> -->

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/dashboard" class="brand-link">
    <div class="w-100 text-center justify-content-center  d-flex">
      <img src="{{ asset('/images/custom_images/lungwo.png') }}" style="width:90px" alt="The Logo" class=" text-center"
         >
         </div>
 
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <router-link to="/profile">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="/{{ auth()->user()->photo }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">

                  {{ Auth::user()->name }}
                  <span class="d-block text-muted">
                    {{ Ucfirst(Auth::user()->type) }}
                  </span>
              </div>
          </div>
        </router-link>

      <!-- Sidebar Menu -->
      @include('layouts.sidebar-menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  {{-- Content Wrapper. Contains page content --}}
  <div class="content-wrapper">
    {{-- Main content --}}
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        {{-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row --> --}}
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <router-view></router-view>

    <vue-progress-bar></vue-progress-bar>

    {{-- /.content --}}
  </div>
  {{-- /.content-wrapper --}}

  {{-- Main Footer --}}
  <footer class="main-footer bg-black text-center" >         
    <strong>Copyright &copy; 2020
    <a style="color:#8867AC;text-decoration:none" href="https://santolio.co.uk"> Luna Wellbeing</a>.</strong> All rights reserved.
    <br>
    Designed & Developed By<strong><a style="color:aqua;text-decoration:none" href="https://nglobals.com"> Nawal Global Systems </a></strong>
</div>
{{-- ./wrapper --}}

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>

<!-- Required datatable js -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
<script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>
</html>
