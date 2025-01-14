<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HCS | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css"
        integrity="sha256-XE4NT4UAtULuSdFWQXaaLSOt0/ZqL5xbX/ObUyf2UTI=" crossorigin="anonymous">

    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        /* Card Styling */
        .card {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Chart Images */
        .card img {
            border-radius: 10px;
            width: 100%;
            height: auto;
            margin-bottom: 1rem;
        }

        /* User Avatar and Info */
        .d-flex.align-items-center img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 1rem;
            border: 2px solid #007bff;
        }

        .d-flex.align-items-center h6 {
            font-weight: bold;
            margin: 0;
        }

        .d-flex.align-items-center small {
            color: #6c757d;
        }

        /* Chart Images in Post */
        .chart-image {
            max-width: 300px;
            height: auto;
            margin-right: 50px;
            /* Adds space between the images */
        }

        /* Caption Text */
        .card-text {
            font-size: 1rem;
            margin-bottom: 1rem;
            font-style: italic;
            /* Adds emphasis to the caption text */
        }

        /* Buttons */
        .card .btn {
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }

        /* Flex layout for Buttons and Image */
        .d-flex.justify-content-between {
            margin-bottom: 1rem;
        }

        /* Make sure images are responsive */
        .d-flex.justify-content-start img {
            max-width: 400px;
            height: auto;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <!-- Notification Count -->
                        @php
                            $unreadCount = auth()->user()->unreadNotifications->count();
                        @endphp
                        @if ($unreadCount > 0)
                            <span class="badge badge-warning navbar-badge">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{ $unreadCount }} Notifications</span>
                        <div class="dropdown-divider"></div>

                        <!-- List Notifications -->
                        @forelse (auth()->user()->unreadNotifications as $notification)
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $notification->data['message'] }}
                                <span
                                    class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                        @empty
                            <a href="#" class="dropdown-item text-center text-muted">
                                No new notifications
                            </a>
                        @endforelse

                    </div>
                </li>


                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user-circle mr-2"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ route('logout') }}" class="dropdown-item bg-danger">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-danger elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">HCS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="/" class="nav-link {{ Request::is('/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        @role('admin')
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ Request::is('master-data*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Master Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('es.index') }}"
                                            class="nav-link {{ Request::is('master-data/energy_sources*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Energy Source</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('cm.index') }}"
                                            class="nav-link {{ Request::is('master-data/commuting_method*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Commuting Method</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('dp.index') }}"
                                            class="nav-link {{ Request::is('master-data/dietary_preferences*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dietary Preferences</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endrole

                        @role('user')
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}"
                                    class="nav-link {{ Request::is('profile*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Profile
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('recommendation.index') }}"
                                    class="nav-link {{ Request::is('recommendation*') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-star"></i>
                                    <p>
                                        Recommendation
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('al.index') }}"
                                    class="nav-link {{ Request::is('activity-log*') ? 'active' : '' }}">

                                    <i class="nav-icon fas fa-journal-whills"></i>
                                    <p>
                                        Activity
                                    </p>
                                </a>
                            </li>
                            <!-- Menu untuk Epic 6: View/Upload Educational Content -->
                            <li class="nav-item">
                                <a href="{{ route('educational-contents.index') }}"
                                    class="nav-link {{ Request::is('educational-contents*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Educational Content</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('posts.index') }}"
                                    class="nav-link {{ Request::is('posts*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Post</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('historical-trends.index') }}"
                                    class="nav-link {{ Request::is('historical-trends') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>Historical Trends</p>
                                </a>
                            </li>
                        @endrole



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
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; HCS 2024.</strong>
            All rights reserved. Love for BIT216
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/js/adminlte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/jszip/jszip.min.js"></script>
    <script src="/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Select2 -->
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
            $('.example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
            });
        @endif
    </script>
</body>

</html>
