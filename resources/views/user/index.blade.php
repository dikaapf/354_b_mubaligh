@extends('layouts.tpl_login')
@section('title')
Beranda | Layanan Online Adminduk Kabupaten Jayawijaya
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Daftar Pengajuan Layanan </h5>
                            <h6 class="card-subtitle">Daftar pengajuan layanan yang pernah dilakukan </h6>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 m-t-30">
                            @if(Auth::guard('web')->user()->status_user==0)
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3> Saat ini akun anda belum di verifikasi. Anda belum dapat membuat pengajuan layanan.
                            </div>
                            @elseif(Auth::guard('web')->user()->status_user==2)
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3> Saat ini akun dalam status PENDING. Silahkan lihat rincian pada menu Informasi.<br>
                                <a class="btn btn-info btn-sm" href="<?= url('/informasi') ?>">KLIK DISINI</a>
                            </div>
                            @else
                            <!-- Card -->
                            <div class="card ">

                                <div class="card-body">

                                    <?php
//                                    print_r($data_pengajuan);
                                    ?>
                                    @if($data_pengajuan)
                                    @foreach ($data_pengajuan as $d)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!--<div class="jumbotron jumbotron-fluid">-->
                                            <div class="container">
                                                <div class="card-header bg-info">
                                                    <div class="d-flex ">
                                                        <div>
                                                            <h5 class="card-title"><img width="10%" src="<?= asset($d->link_gambar) ?>" alt="user" class="img-circle">
                                                                <span class="m-b-0 text-white" style="font-size: 14pt"><?= $d->nama_layanan ?></span></h5>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">

                                                            <tr>
                                                                <td colspan="2"><?= $d->deskripsi ?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>Nomor Pengajuan</td>
                                                                <td>: <?= ($d->nomor_pengajuan) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal Pengajuan</td>
                                                                <td>: <?= tgltime_angka($d->tanggal_pengajuan) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status Proses</td>
                                                                <td>: <b><?= $d->nama_pengajuan ?></b></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="row card-body">


                                                        <div class="col-md-6">
                                                            <a href="<?= url('/data-pengajuan/cetak/' . Crypt::encrypt($d->id) . '/cetak') ?>" class="btn btn-facebook btn-rounded btn-block"><i class="fa fa-print"></i> &nbsp; Cetak Pdf</a>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="<?= url('/pengajuan/' . $d->id . '/detail') ?>" class="btn btn-info btn-rounded btn-block"><i class="fa fa-eye"></i> &nbsp; Detail</a>

                                                        </div>
                                                    </div>

                                                    @if($d->kirim_syarat==1)

                                                    <div class="row card-body">
                                                        <div class="col-md-6">
                                                            <a target="_blank" href=<?= url('/data-pengajuan/cetaklabel/' . Crypt::encrypt($d->id)) ?>" class="btn btn-warning btn-rounded btn-block"><i class="fa fa-envelope"></i> &nbsp; Cetak Label ALamat</a>

                                                        </div>
                                                        <div class="col-md-6">

                                                        </div>

                                                    </div>

                                                    @endif

                                                </div>
                                            </div>
                                            <!--</div>-->

                                        </div>

                                    </div>


                                    @endforeach 
                                    @else 
                                    <h4 class="card-title">anda belum melakukan pengajuan layanan! </h4>
                                    <p class="card-text">Klik tombol berikut untuk memilih jenis layanan.</p>
                                    <a href="<?= url('/') ?>" class="btn btn-info">Daftar Layanan</a>
                                    @endif

                                </div>
                                <div class="card-footer text-muted">
                                    Tanggal hari ini : <?= date('d-m-Y') ?>
                                </div>
                            </div>
                            <!-- Card -->
                            @endif

                        </div>
                    </div>
                </div>
                <!-- End Row -->  

            </div>
        </div>

    </div>
    @endsection
