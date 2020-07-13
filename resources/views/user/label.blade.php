<!doctype html>
<html lang="en" dir="ltr">
    <?php

    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="I1uBVvwqshgYemu8WmohpQhgJthkfGnIYvKI8idY">
        <meta name="author" content="Bambang Mahesthi, kidipridi@gmail.com">
        <meta name="description" content="Layanan Online Administrasi Kependudukan dan Pencatatan Sipil Kabupaten Jayawijaya">
        <meta name="keywords" content="kartu keluarga, kk, ktp, ktp elektronik, ektp, e-ktp, kia, akta, akta kelahiran, akta kematian, akta perkawinan, akta perceraian, pindah, datang, surat pindah, surat rekomendasi kedatangan, adminduk, bambang mahesthi, kidi pridi">

        <link rel="icon" href="<?= asset('img/logo_jwy_50.png') ?>" type="image/x-icon">    
        <link rel="apple-touch-icon" href="<?= asset('img/logo_jwy_50.png') ?>">
        <link rel="shortcut icon" href="<?= asset('img/logo_jwy_50.png') ?>" type="image/x-icon" >

        <title>Label Alamat | Layanan Online Adminduk Kabupaten Jayawijaya</title>

        <link rel="stylesheet" href="<?= asset('label') ?>/bootstrap.min.css">
        <link rel="stylesheet" href="<?= asset('label') ?>/style.min.css">
        <link rel="stylesheet" href="<?= asset('label') ?>/fade-down.css">
        <link rel="stylesheet" href="<?= asset('label') ?>/horizontalmenu.css">
        <link rel="stylesheet" href="<?= asset('label') ?>/font-awesome.min.css">
    </head>

    <body class="app sidebar-mini rtl bg-white">
        <div class="page">
            <div class="page-main bg-white">
                <div class="container content-area">
                    <div class="side-app">
                        <div class="row match-height">



                            <div class="col-12 mt-4">
                                <div class="card border-dark border">
                                    <div class="card-body">
                                        <hr class="mb-2" style="border: 1px dashed #000000; width: 95%;">
                                        <div class="row">
                                            <div class="col-3">
                                                <?php
                                                $image = QrCode::format('png')
                                                        ->merge(public_path('img\logo_jyw.png'), 0.2, true)
                                                        ->size(800)->errorCorrection('H')
                                                        ->generate($pengajuan->nomor_pengajuan);
                                                ?>
                                                <img width="90%" src="data:image/png;base64, {!! base64_encode($image) !!} ">
                                            </div>
                                            <div class="col-9">
                                                <div class="text-left ml-6 mt-6">
                                                    <h3 class="mb-3">Kepada :</h3>
                                                    <h3 class="mb-3"><span class="font-weight-semibold">Dinas Kependudukan dan Pencatatan Sipil Kabupaten Jayawijaya</span></h3>
                                                    <h3>Jalan Yos Sudarso, Wamena, Kabupaten Jayawijaya, Papua 99501</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="mt-3" style="border: 1px dashed #000000; width: 95%;">
                                        <div class="row mb-5">
                                            <div class="col-12">
                                                <h4 class="text-center"><span class="font-weight-semibold">Checklist Kelengkapan Berkas Persyaratan</span></h4>		
                                                <h5 class="text-center">Layanan Layanan Kartu Keluarga</h5>		
                                            </div>
                                        </div>
                                        <div class="table-responsive push ml-5 mr-5" style="width: 95%;">
                                            <table class="table table-bordered table-hover mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-center" style="width: 2%">No</th>
                                                        <th class="text-center">Nama Persyaratan</th>
                                                        <th class="text-center" style="width: 2%">Check</th>
                                                    </tr>
<?php $no = 1 ?>
                                                    @foreach($persyaratan as $d)
                                                    <tr>
                                                        <td class="text-center"><?= $no ?>.</td>
                                                        <td>
                                                            <p class="mb-1"><?= $d->nama_persyaratan ?></p>
                                                        </td>
                                                        <td class="text-center">...</td>
                                                    </tr>
<?php $no++ ?>  
                                                    @endforeach


                                                    <tr>
                                                        <td colspan="3" class="font-weight-bold text-uppercase text-right"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>