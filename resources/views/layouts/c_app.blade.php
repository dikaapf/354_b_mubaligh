<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Bootstrap Admin Theme</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= asset('/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?= asset('/') ?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="<?= asset('/') ?>vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?= asset('/') ?>vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="<?= asset('/') ?>vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="<?= asset('/') ?>vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= asset('/') ?>dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?= asset('/') ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Sistem Informasi Pengarsipan Surat</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            @if(Auth::guard('web')->check())
                            User
                            @endif
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            @if (Auth::guest())
                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><i class="fa fa-key"></i> Masuk</a>




                            </li>
                            @endif


                            @if(Auth::guard('web')->check())
                            <li class="divider"></li>
                            <li><a href="<?= route('admin.logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                            @endif
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                @include('components.menu')
                <!-- /.navbar-static-side -->
            </nav>
            @yield('content')

            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="<?= asset('/') ?>vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?= asset('/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?= asset('/') ?>vendor/metisMenu/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="<?= asset('/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?= asset('/') ?>vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="<?= asset('/') ?>vendor/datatables-responsive/dataTables.responsive.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="<?= asset('/') ?>/vendor/moment/min/moment.min.js"></script>
        <script src="<?= asset('/') ?>/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-datetimepicker -->    
        <script src="<?= asset('/') ?>/vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= asset('/') ?>dist/js/sb-admin-2.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        @yield('scripts')

    </body>

</html>
