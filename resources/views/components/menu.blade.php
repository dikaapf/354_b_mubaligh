<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?= url('/admin') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            @if(Auth::guard('admin')->check())



            <li>
                <a href="#"><i class="fa fa-file fa-fw"></i> Kelola Arsip Surat<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= url('suratmasuk/create') ?>"><i class="fa fa-pencil fa-fw"></i> Entry Surat Masuk</a>
                    </li>
                    <li>
                        <a href="<?= url('suratmasuk') ?>"><i class="fa fa-inbox fa-fw"></i> Data Surat Masuk</a>
                    </li>
                    <li>
                        <a href="<?= url('suratkeluar/create') ?>"><i class="fa fa-reply fa-fw"></i> Entry Surat Keluar</a>
                    </li>
                    <li>
                        <a href="<?= url('suratkeluar') ?>"><i class="fa fa-mail-reply-all fa-fw"></i> Surat Keluar</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-gears fa-fw"></i> Pengaturan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= url('kategorisurat') ?>"><i class="fa fa-folder fa-fw"></i> Jenis Surat</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            @endif

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>