<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <!-- Custom CSS -->
        <link href="<?= asset('/sig/dist') ?>/css/style.min.css" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="<?= asset('/sig/dist') ?>/css/pages/dashboard1.css" rel="stylesheet">
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

            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">


                            <li> <a class="" href="<?= url('user') ?>" ><i class="icon-home"></i><span class="hide-menu">Beranda </span></a>

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
        <script src="<?= asset('/sig/dist') ?>/js/pages/validation.js"></script>
        <!-- Magnific popup JavaScript -->
        <script src="<?= asset('/sig') ?>/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
        <script src="<?= asset('/sig') ?>/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
        <script>
            !function (window, document, $) {
                "use strict";
                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
            }(window, document, jQuery);
        </script>

        <script src="<?= asset('/sig/dist') ?>/js/dashboard1.js"></script>
        <!-- This is data table -->
        <!--<script src="<?= asset('/sig') ?>/assets/node_modules/datatables/jquery.dataTables.min.js"></script>-->
        @yield('scripts')
    </body>

</html>