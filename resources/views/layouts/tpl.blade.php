<?php
$d = \App\Setupaplikasi::findOrFail(1);
?>
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
        <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('public/sig') ?>/assets/images/favicon.png">
        <title>@yield('title')</title> 
        <!-- This page CSS -->
        <link href="<?= asset('public/sig') ?>/assets/node_modules/switchery/dist/switchery.min.css" rel="stylesheet" />
        <link href="<?= asset('public/sig') ?>/dist/css/pages/ui-bootstrap-page.css" rel="stylesheet">  <!-- chartist CSS -->
        <link href="<?= asset('public/sig') ?>/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
        <!--Toaster Popup message CSS -->
        <link href="<?= asset('public/sig') ?>/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
        <!-- Popup CSS -->
        <link href="<?= asset('public/sig') ?>/assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= asset('public/sig/dist') ?>/css/style.min.css" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="<?= asset('public/sig/dist') ?>/css/pages/dashboard1.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <script>
            $(function () {
                $(".banner-title").typed({
                    strings: ["Multipurpose Admin template with Bootstrap 4", "Build Your backend in No-Time for any plateform", "Powerfull webapp kit with countless features"],
                    typeSpeed: 100,
                    loop: true
                });
            });
        </script>
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
                        <a class="navbar-brand" href="<?= url('/') ?>"><img width="100%" src="<?= asset('public/' . $d->logo_index) ?>" /></a>

                    </div>
                    <!--<p class="navbar-header"></p>-->

                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse">
                        <div class="padding-4">
                            <span style="color: white;font-weight: bold">
                                <!--DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KABUPATEN JAYAWIJAYA-->
                            </span>
                        </div>

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
                            @if(Auth::guard('web')->check())
                            <li class="nav-item dropdown u-pro">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= asset('public/sig') ?>/assets/images/users/user.png" alt="user" class=""> <span class="hidden-md-down"><?= Auth::guard('web')->user()->name ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <a href="<?= url('public/user/logout') ?>" class="dropdown-item"><i class="ti-export"></i> Keluar</a>

                                </div>
                            </li>
                            @else
                            <li class="nav-item dropdown u-pro">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= asset('public/sig') ?>/assets/images/users/user.png" alt="user" class=""> <span class="hidden-md-down">Login &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <a href="<?= url('public/user') ?>" class="dropdown-item"><i class="ti-user"></i> Pengguna</a>

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

                            <li> <a class="" href="<?= url('/') ?>" ><i class="icon-home"></i><span class="hide-menu"> Beranda </span></a>

                            </li>



                            @if(Auth::guard('web')->check())
                            <li> <a class="" href="<?= url('public/user') ?>" ><i class="fa fa-users"></i><span class="hide-menu"> Pengguna </span></a>

                            </li>
                            <li> <a class="" href="<?= url('public/informasi') ?>" ><i class="fa fa-desktop"></i><span class="hide-menu"> Informasi  </span></a>

                            </li> 

                            @else 
                            <li> <a class="" href="<?= url('public/register') ?>" ><i class="fa fa-user-plus"></i><span class="hide-menu"> Pendaftaran User </span></a>

                            </li>

                            @endif

                            <li> <a class="" href="<?= url('public/bantuan') ?>" ><i class="fa fa-question-circle"></i><span class="hide-menu"> Bantuan </span></a>

                            </li>
                            <li> <a class="" href="<?= url('public/info') ?>" ><i class="fa fa-newspaper-o"></i><span class="hide-menu"> Informasi / Pengumuman </span></a>

                            </li>

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
                <style>
                    .example1 {
                        height: 35px;  
                        overflow: hidden;
                        position: relative;
                    }
                    .example1 h4 {
                        font-size: 2em;
                        color: blue;
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        margin: 0;
                        line-height: 30px;
                        text-align: center;
                        /* Starting position */
                        -moz-transform:translateX(100%);
                        -webkit-transform:translateX(100%);    
                        transform:translateX(100%);
                        /* Apply animation to this element */  
                        -moz-animation: example1 20s linear infinite;
                        -webkit-animation: example1 20s linear infinite;
                        animation: example1 20s linear infinite;
                    }
                    /* Move it (define the animation) */
                    @-moz-keyframes example1 {
                        0%   { -moz-transform: translateX(100%); }
                        100% { -moz-transform: translateX(-100%); }
                    }
                    @-webkit-keyframes example1 {
                        0%   { -webkit-transform: translateX(100%); }
                        100% { -webkit-transform: translateX(-100%); }
                    }
                    @keyframes example1 {
                        0%   { 
                            -moz-transform: translateX(100%); /* Firefox bug fix */
                            -webkit-transform: translateX(100%); /* Firefox bug fix */
                            transform: translateX(100%);       
                        }
                        100% { 
                            -moz-transform: translateX(-100%); /* Firefox bug fix */
                            -webkit-transform: translateX(-100%); /* Firefox bug fix */
                            transform: translateX(-100%); 
                        }
                    }
                </style>
                <div class="example1">
                    <h4>Selamat Datang Di Layanan Online Administrasi Kependudukan Dinas Kependudukan dan Pencatatan Sipil Kabupaten Jayawijaya </h4>
                </div>
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


            <footer class="footer text-center">
                <span class="card-title">
                    © 2020 - <?= ($d->nama_dinas) ?> <?= ($d->nama_kabupaten) ?>

                </span>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Wrapper -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <script src="<?= asset('public/sig') ?>/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="<?= asset('public/sig') ?>/assets/node_modules/popper/popper.min.js"></script>
            <script src="<?= asset('public/sig') ?>/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- slimscrollbar scrollbar JavaScript -->
            <script src="<?= asset('public/sig/dist') ?>/js/perfect-scrollbar.jquery.min.js"></script>
            <!--Wave Effects -->
            <script src="<?= asset('public/sig/dist') ?>/js/waves.js"></script>
            <!--Menu sidebar -->
            <script src="<?= asset('public/sig/dist') ?>/js/sidebarmenu.js"></script>
            <!--stickey kit -->
            <script src="<?= asset('public/sig') ?>/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
            <script src="<?= asset('public/sig') ?>/assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
            <!--Custom JavaScript -->
            <script src="<?= asset('public/sig/dist') ?>/js/custom.min.js"></script>
            <script src="<?= asset('public/sig') ?>/assets/node_modules/switchery/dist/switchery.min.js"></script>
            <!-- Popup message jquery -->
            <script src="<?= asset('public/sig') ?>/assets/node_modules/toast-master/js/jquery.toast.js"></script>
            <!-- Chart JS -->
            <script src="<?= asset('public/sig') ?>/dist/js/pages/validation.js"></script>
            <script src="<?= asset('public/sig') ?>/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
            <script src="<?= asset('public/sig') ?>/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
            <script>
            !function (window, document, $) {
                "use strict";
                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
            }(window, document, jQuery);
            </script>
            @yield('scripts')
    </body>

</html>