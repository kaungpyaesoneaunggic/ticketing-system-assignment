<!DOCTYPE html>
<html lang="en">
<head>
  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Dashboard</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css")}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{ asset("plugins/jqvmap/jqvmap.min.css")}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css")}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset("plugins/daterangepicker/daterangepicker.css")}}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css")}}">
<link rel="stylesheet" href="{{asset('css/index.css')}}">
<link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src={{ asset("dist/img/AdminLTELogo.png")}} alt="AdminLTELogo" height="60" width="60">
  </div>
 
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light custom-nav">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" onclick="requestFullscreen();" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src={{ asset("dist/img/AdminLTELogo.png")}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GIC Shopping</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{ asset("dist/img/user2-160x160.jpg")}} class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            @if(Auth::user()->role != 0)
            <li class="nav-item">
                <a href="{{ route('ticket.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>
                        Ticket List
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('ticket.create') }}" class="nav-link">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>
                        Ticket Create
                    </p>
                </a>
            </li>
            @else
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Users List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('user.create') }}" class="nav-link">
              <i class="nav-icon fas fa-add"></i>
              <p>
                Users Create
              </p>
            </a>
          </li>
          <br>
          <li class="nav-item">
            <a href="{{ route('category.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Category List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('category.create') }}" class="nav-link">
              <i class="nav-icon fas fa-add"></i>
              <p>
                Category Create
              </p>
            </a>
          </li>
          <br>
          <li class="nav-item">
            <a href="{{ route('label.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Label List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('label.create') }}" class="nav-link">
              <i class="nav-icon fas fa-add"></i>
              <p>
                Label Create
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
    </div>
  </aside>
  {{-- I want this to have vertical scroll when the content get bigger No horizontal scroll --}}
  <div class="content-wrapper d-flex flex-column" style="overflow-y: auto; overflow-x:hidden;">
    <div class="row mb-2 flex-grow-1">
        @yield('content')
    </div>  
</div>
 @extends('dashboard.footer')
</body>
</html>
