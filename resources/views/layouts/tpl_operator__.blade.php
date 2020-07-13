<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('/sig') ?>/assets/images/favicon.png">
        <title>@yield('title')</title>
        <!-- This page CSS -->
        <!-- chartist CSS -->
        <link href="<?= asset('/sig') ?>/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
        <!--Toaster Popup message CSS -->
        <link href="<?= asset('/sig') ?>/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
        <!-- Popup CSS -->
        <link href="<?= asset('/sig') ?>/assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
        <!--alerts CSS -->
        <link href="<?= asset('/sig') ?>/assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"><!-- Custom CSS -->
        <!-- Date picker plugins css -->
        <link href="<?= asset('/sig') ?>/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /><link href="<?= asset('/sig/dist') ?>/css/style.min.css" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="<?= asset('/sig/dist') ?>/css/pages/dashboard1.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    </head>

    <body class="horizontal-nav skin-megna fixed-layout">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Memproses permintaan...</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?= url('/') ?>">SIPPDK</a>

                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse">
                        <!-- ============================================================== -->
                        <!-- toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav mr-auto">
                            <!-- This is  -->
                            <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <li class="nav-item"> <a class="nav-link sidebartoggler d-none waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                            <!-- ============================================================== -->
                            <!-- Search -->
                            <!-- ============================================================== -->

                        </ul>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav my-lg-0">


                            <!-- ============================================================== -->
                            <!-- End mega menu -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- User Profile -->
                            <!-- ============================================================== -->
                            @if(Auth::guard('operator')->check())

                            <li class="nav-item dropdown u-pro">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= asset('/sig') ?>/assets/images/users/user.png" alt="user" class=""> <span class="hidden-md-down">Aksi &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <!-- text-->
                                    <a href="{{ route('operator.logout') }}" class="dropdown-item"><i class="ti-user"></i> Keluar Operator</a>
                                    <!-- text-->

                                    <!-- text-->
                                </div>
                            </li>
                            @endif

                            <!-- ============================================================== -->
                            <!-- End User Profile -->
                            <!-- ============================================================== -->
                        </ul>
                    </div>
                </nav>
            </header>

            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">

                        <ul id="sidebarnav">


                            <li> <a class="" href="<?= url('operator') ?>" ><i class="icon-home"></i><span class="hide-menu">Beranda </span></a>

                            </li>
                            <li> <a class="" href="<?= url('pengguna') ?>" ><i class="icon-user-following"></i><span class="hide-menu">Pengguna </span></a>

                            </li>
                            <li> <a class="" href="<?= url('daftar-pengajuan') ?>" ><i class="icon-list"></i><span class="hide-menu">Daftar Pengajuan </span></a>

                            </li>
<!--                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-users"></i><span class="hide-menu">Manajemen Pengguna</span></a>
                                <ul aria-expanded="false" class="collapse">

                                    <li><a href="<?= url('/pengguna') ?>">Data Pengguna</a></li>
                                    <li><a href="<?= url('/pengguna/tambah') ?>">Tambah Pengguna</a></li>

                                </ul>
                            </li>-->


                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">

                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                @yield('content')
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2018
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="<?= asset('/sig') ?>/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?= asset('/sig') ?>/assets/node_modules/popper/popper.min.js"></script>
        <script src="<?= asset('/sig') ?>/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="<?= asset('/sig/dist') ?>/js/perfect-scrollbar.jquery.min.js"></script>
        <!--Wave Effects -->
        <script src="<?= asset('/sig/dist') ?>/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="<?= asset('/sig/dist') ?>/js/sidebarmenu.js"></script>
        <!--stickey kit -->
        <script src="<?= asset('/sig') ?>/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="<?= asset('/sig') ?>/assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
        <!--Custom JavaScript -->
        <script src="<?= asset('/sig/dist') ?>/js/custom.min.js"></script>
        <!-- This is data table -->
        <script src="<?= asset('/sig') ?>/assets/node_modules/datatables/jquery.dataTables.min.js"></script>
        <!-- Popup message jquery -->
        <script src="<?= asset('/sig') ?>/assets/node_modules/toast-master/js/jquery.toast.js"></script>
        <script src="<?= asset('/sig') ?>/dist/js/pages/validation.js"></script>
        <script src="<?= asset('/sig') ?>/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
        <script src="<?= asset('/sig') ?>/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
        <!-- Sweet-Alert  -->
        <script src="<?= asset('/sig') ?>/assets/node_modules/sweetalert/sweetalert.min.js"></script>
        <!-- Date Picker Plugin JavaScript -->
        <script src="<?= asset('/sig') ?>/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        @yield('scripts')
    </body>

</html>
