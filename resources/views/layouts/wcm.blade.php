<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Selamat Datang </title>

        <!-- Bootstrap -->
        <link href="<?= asset('/') ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?= asset('/') ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?= asset('/') ?>vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="<?= asset('/') ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?= asset('/') ?>build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>SIPDK</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">

                            <div class="profile_info">

                                <h2>Disdukcapil</h2>
                                <span>Kabupaten Jayawijaya</span>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Beranda <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?= url('/') ?>">Dashboard</a></li>

                                        </ul>
                                    </li>

                                </ul>
                            </div>


                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->

                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">

                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?= asset('/') ?>images/img.jpg" alt="">Selamat Datang
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">

                                        <li>

                                            @if (Auth::check())
                                            <a href="{{ url('/home') }}">Home</a>
                                            @else
                                            <a href="{{ url('admin/login') }}">Login</a>
                                            @endif
                                        </li>
                                        <li><a href="javascript:void(0);" onclick="alert('APLIKASI INI DIKEMBANGKAN OLEH\nABDURRAHMAN A. BULUATIE, S.Kom\nKEPALA SEKSI PENGOLAHAN DAN PENYAJIAN\nDATA KEPENDUDUKAN\nDINAS KEPENDUDUKAN DAN PENCATATAN SIPIL\nKABUPATEN JAYAWIJAYA\nPADA\nProyek Perubahan Diklat PIM IV\nANGKATAN I KABUPATEN JAYAWIJAYA\nTAHUN 2018\n\nPERMINTAAN SERIAL KEY DAPAT MENGHUBUNGI \nEMAIL oman.buluatie@gmail.com ')">Tentang Aplikasi</a></li>

                                    </ul>
                                </li>


                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">

                        <div class="clearfix"></div>

                        <div class="row">
                            @yield('content')
                            
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Wamena 2018 - Proyek Perubahan Diklat PIM IV Kabupaten Jayawijaya
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?= asset('/') ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?= asset('/') ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="<?= asset('/') ?>vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?= asset('/') ?>vendors/nprogress/nprogress.js"></script>
        <!-- morris.js -->
        <script src="<?= asset('/') ?>vendors/raphael/raphael.min.js"></script>
        <script src="<?= asset('/') ?>vendors/morris.js/morris.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="<?= asset('/') ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="<?= asset('/') ?>vendors/moment/min/moment.min.js"></script>
        <script src="<?= asset('/') ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="<?= asset('/') ?>build/js/custom.js"></script>
        @yield('scripts')

    </body>
</html>