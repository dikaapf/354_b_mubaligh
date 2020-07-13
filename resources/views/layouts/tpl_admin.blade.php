<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('public/skin') ?>/assets/images/favicon.png">
        <title>@yield('title')</title>
        <!-- This page CSS -->
        <!-- chartist CSS -->
        <link href="<?= asset('public/skin') ?>/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
        <!--Toaster Popup message CSS -->
        <link href="<?= asset('public/skin') ?>/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
        <!-- Morris CSS -->
        <link href="<?= asset('public/skin') ?>/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= asset('public/skin') ?>/dist/css/style.css" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="<?= asset('public/skin') ?>/dist/css/pages/dashboard1.css" rel="stylesheet">

    </head>

    <body class="skin-blue fixed-layout">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Memproses permintaan</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.html">
                            <!-- Logo icon --><b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="<?= asset('public/img') ?>/logo_42.png" alt="homepage" width="100%" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="<?= asset('public/img') ?>/logo_42.png" alt="homepage" width="100%" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <span class="hidden-xs"><span class="font-bold">Mubaligh.id</span></span>
                        </a>
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
                            <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                            <!-- ============================================================== -->
                            <!-- Search -->
                            <!-- ============================================================== -->
                            <li class="nav-item">
                                <form class="app-search d-none d-md-block d-lg-block">
                                    <input type="text" class="form-control" placeholder="Search & enter">
                                </form>
                            </li>
                        </ul>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav my-lg-0">
                            <!-- ============================================================== -->
                            <!-- Comment -->
                            <!-- ============================================================== -->
                            <!--                            <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                                                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                                                <ul>
                                                                    <li>
                                                                        <div class="drop-title">Notifications</div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="message-center">
                                                                             Message 
                                                                            <a href="javascript:void(0)">
                                                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                                                <div class="mail-contnet">
                                                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                                                            </a>
                                                                             Message 
                                                                            <a href="javascript:void(0)">
                                                                                <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                                                <div class="mail-contnet">
                                                                                    <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                                                            </a>
                                                                             Message 
                                                                            <a href="javascript:void(0)">
                                                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                                                <div class="mail-contnet">
                                                                                    <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                                                            </a>
                                                                             Message 
                                                                            <a href="javascript:void(0)">
                                                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                                                <div class="mail-contnet">
                                                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                         ============================================================== 
                                                         End Comment 
                                                         ============================================================== 
                                                         ============================================================== 
                                                         Messages 
                                                         ============================================================== 
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-note"></i>
                                                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                                            </a>
                                                            <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
                                                                <ul>
                                                                    <li>
                                                                        <div class="drop-title">You have 4 new messages</div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="message-center">
                                                                             Message 
                                                                            <a href="javascript:void(0)">
                                                                                <div class="user-img"> <img src="<?= asset('public/skin') ?>/assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                                                <div class="mail-contnet">
                                                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                                                            </a>
                                                                             Message 
                                                                            <a href="javascript:void(0)">
                                                                                <div class="user-img"> <img src="<?= asset('public/skin') ?>/assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                                                <div class="mail-contnet">
                                                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                                                            </a>
                                                                             Message 
                                                                            <a href="javascript:void(0)">
                                                                                <div class="user-img"> <img src="<?= asset('public/skin') ?>/assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                                                <div class="mail-contnet">
                                                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                                                            </a>
                                                                             Message 
                                                                            <a href="javascript:void(0)">
                                                                                <div class="user-img"> <img src="<?= asset('public/skin') ?>/assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                                                <div class="mail-contnet">
                                                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <a class="nav-link text-center link" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>-->
                            <!-- ============================================================== -->
                            <!-- End Messages -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- mega menu -->
                            <!-- ============================================================== -->
<!--                            <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-layout-width-default"></i></a>
                                <div class="dropdown-menu animated bounceInDown">
                                    <ul class="mega-dropdown-menu row">
                                        <li class="col-lg-3 col-xlg-2 m-b-30">
                                            <h4 class="m-b-20">CAROUSEL</h4>
                                            CAROUSEL 
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="carousel-item active">
                                                        <div class="container"> <img class="d-block img-fluid" src="<?= asset('public/skin') ?>/assets/images/big/img1.jpg" alt="First slide"></div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="container"><img class="d-block img-fluid" src="<?= asset('public/skin') ?>/assets/images/big/img2.jpg" alt="Second slide"></div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="container"><img class="d-block img-fluid" src="<?= asset('public/skin') ?>/assets/images/big/img3.jpg" alt="Third slide"></div>
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                            </div>
                                            End CAROUSEL 
                                        </li>
                                        <li class="col-lg-3 m-b-30">
                                            <h4 class="m-b-20">ACCORDION</h4>
                                            Accordian 
                                            <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="headingOne">
                                                        <h5 class="mb-0">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                Collapsible Group Item #1
                                                            </a>
                                                        </h5> </div>
                                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high. </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="headingTwo">
                                                        <h5 class="mb-0">
                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                Collapsible Group Item #2
                                                            </a>
                                                        </h5> </div>
                                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="headingThree">
                                                        <h5 class="mb-0">
                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                Collapsible Group Item #3
                                                            </a>
                                                        </h5> </div>
                                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-lg-3  m-b-30">
                                            <h4 class="m-b-20">CONTACT US</h4>
                                            Contact 
                                            <form>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="Enter email"> </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </form>
                                        </li>
                                        <li class="col-lg-3 col-xlg-4 m-b-30">
                                            <h4 class="m-b-20">List style</h4>
                                            List style 
                                            <ul class="list-style-none">
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>-->
                            <!-- ============================================================== -->
                            <!-- End mega menu -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- User Profile -->
                            <!-- ============================================================== -->
                            @if(Auth::guard('admin')->check())     
                            <li class="nav-item dropdown u-pro">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= asset('public/skin') ?>/assets/images/users/1.jpg" alt="user" class=""> <span class="hidden-md-down"><?= Auth::guard('admin')->user()->name ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <!-- text-->
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                    <!-- text-->
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                                    <!-- text-->
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                                    <!-- text-->
                                    <div class="dropdown-divider"></div>
                                    <!-- text-->
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                                    <!-- text-->
                                    <div class="dropdown-divider"></div>
                                    <!-- text-->
                                    <a href="<?= url('/admin/logout') ?>" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
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
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?= asset('public/skin') ?>/assets/images/users/1.jpg" alt="user-img" class="img-circle"><span class="hide-menu"><?= Auth::guard('admin')->user()->name ?></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <!--<li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>-->
                                    <!--<li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>-->
                                    <!--<li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>-->
                                    <!--<li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>-->
                                    <li><a href="<?= url('/admin/logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="index.html"><i class="icon-speedometer"></i><span class="hide-menu">Beranda</span></a>
                            </li>
<!--                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Kelola</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="app-calendar.html">User</a></li>
                                    <li><a href="app-ticket.html">Kategori</a></li>
                                    <li><a href="app-contact.html">Booking</a></li>
                                    <li><a href="app-contact2.html">Jadwal</a></li>
                                    <li><a href="app-contact-detail.html">Jenis Pembayaran</a></li>
                                </ul>
                            </li>-->
                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-building"></i><span class="hide-menu">Kategori</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= url('kategori') ?>">List Kategori</a></li>
                                    <li><a href="{{ url('kategori/create') }}">Tambah Kategori</a></li>
                                </ul>
                            </li>

                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-people"></i><span class="hide-menu">Pengajar</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= url('pengajar') ?>">List Pengajar</a></li>
                                    <li><a href="<?= url('pengajar/create') ?>">Tambah Pengajar</a></li>
                                    <li><a href="university-professors.html">Set Pengajar</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-graduation-cap"></i><span class="hide-menu">Pengguna</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= url('admin/pengguna') ?>">List Pengguna</a></li>
                                    <li><a href="university-add-student.html">Add Student</a></li>
                                    <li><a href="university-edit-student.html">Edit Student</a></li>
                                    <li><a href="university-student-profile.html">Student Profile</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-bars"></i><span class="hide-menu">Jadwal</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="university-courses.html">All Courses</a></li>
                                    <li><a href="university-add-course.html">Add Course</a></li>
                                    <li><a href="university-edit-course.html">Edit Course</a></li>
                                    <li><a href="university-course-info.html">Course Information</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Booking</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="university-library-assets.html">Library Assets</a></li>
                                    <li><a href="university-add-asset.html">Add Library Asset</a></li>
                                    <li><a href="university-edit-asset.html">Edit Library Asset</a></li>
                                </ul>
                            </li>

                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-chart"></i><span class="hide-menu">Laporan</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="university-general-report.html">General Report</a></li>
                                    <li><a href="university-income-report.html">Income Report</a></li>
                                    <li><a href="university-expense-report.html">Expense Report</a></li>
                                </ul>
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
                © 2018 Eliteadmin by themedesigner.in
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
        <script src="<?= asset('public/skin') ?>/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="<?= asset('public/skin') ?>/assets/node_modules/popper/popper.min.js"></script>
        <script src="<?= asset('public/skin') ?>/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="<?= asset('public/skin') ?>/dist/js/perfect-scrollbar.jquery.min.js"></script>
        <!--Wave Effects -->
        <script src="<?= asset('public/skin') ?>/dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="<?= asset('public/skin') ?>/dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="<?= asset('public/skin') ?>/dist/js/custom.min.js"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->
        <!--morris JavaScript -->
        <script src="<?= asset('public/skin') ?>/assets/node_modules/raphael/raphael-min.js"></script>
        <script src="<?= asset('public/skin') ?>/assets/node_modules/morrisjs/morris.min.js"></script>
        <script src="<?= asset('public/skin') ?>/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
        <!-- Popup message jquery -->
        <script src="<?= asset('public/skin') ?>/assets/node_modules/toast-master/js/jquery.toast.js"></script>
        <!-- Chart JS -->
        <script src="<?= asset('public/skin') ?>/dist/js/dashboard1.js"></script>
        <!-- This is data table -->
        <script src="<?= asset('public/skin') ?>/assets/node_modules/datatables/jquery.dataTables.min.js"></script>
        @yield('scripts')
    </body>

</html>