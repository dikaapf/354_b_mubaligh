<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

$d = \App\Setupaplikasi::findOrFail(1);
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Cetak Petunjuk Pengajuan</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- Custom CSS -->
        <!-- Dashboard 1 Page CSS -->
        <link href="<?= asset('/sig/dist') ?>/css/pages/dashboard1.css" rel="stylesheet">
        <style>
            .page-break {
                page-break-after: always;
            }
            body{
                font-family: sans-serif;
            }
            .s_container {
                display: flex; /*flex*/
            }
            .ssm_opcion {
                /*background: grey;*/
            }
            .ssm_opcion img {
                width: 600px;
                height: 100%;
            }
            #text_opcion {
                background: green;
                flex: 1 0 50px; /*grow + no shrink + basis*/
                display: flex; /*flex*/
                justify-content: flex-end; /*horizontal right*/
                align-items: flex-end; /*vertical bottom*/
            }
        </style>
    </head>
    <!--<h1>Page 1</h1>
<div class="page-break"></div>-->
    <body >
        <div class="container">
            <!-- Bootstrap -->
            <link rel="stylesheet" href="<?= asset('/') ?>/css/pdf.css">
            <div style="text-align: center; color: #005983">
                <h2><?= strtoupper($d->nama_pemerintah) ?><br>
                    <?= strtoupper($d->nama_dinas) ?></h2>
                <H3 class="bold"><?= strtoupper($d->slogan_header) ?></H3>
                <H4 class="bold"><?= ($d->alamat_website) ?><br>Nomor Whatsapp : <?= strtoupper($d->no_wa) ?></H4>
                <h3><u>PETUNJUK PENGAJUAN </u><br><?= $items['pelayanan']->nama_layanan ?></h3>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">

                        <h3 class="card-title text-info">Deskripsi Layanan</h3>
                        <p class="text-justify"><?= $items['pelayanan']->deskripsi ?></p>

                        <h3>Pengambilan Dokumen</h3>
                        @if($items['pelayanan']->ambil_dok==0)

                        <p>Pemohon tidak perlu mengambil dokumen kependudukan yang telah diterbitkan karena dapat dicetak sendiri. 
                            Namun jika pemohon menghendaki dokumen yang dicetak menggunakan blanko, penduduk dapat mengunjungi Dinas Kependudukan dan 
                            dan Pencatatan Sipil Kabupaten Jayawijaya</p>

                        @endif
                        @if($items['pelayanan']->kirim_dok==0)
                        <div class="alert alert-info">
                            <p>Dokumen dapat di unduh pemohon setelah selesai diproses.</p>

                        </div>
                        @endif
                        <h3 class="card-title text-info">Persyaratan</h3>
                        <p class="text-justify">Daftar persyaratan yang harus dipenuhi oleh pemohon sebelum melakukan pengajuan layanan ini adalah sebagai berikut : 
                        </p>
                        <ol class="list-icons">
                            @foreach($items['persyaratan'] as $d)
                            <li><i class="fa fa-check text-info"></i> <?= $d->nama_persyaratan ?></li>

                            @endforeach
                        </ol>
                        <!--<div class="page-break"></div>-->

                        <h3 class="card-title text-info">Mekanisme Pengajuan</h3>
                        <p class="text-justify">Mekanisme pengajuan yang harus dilakukan oleh pemohon terkait layanan ini : 
                        </p>
                        <ol class="list-icons">
                            @foreach($items['mekanisme'] as $d)
                            <li><i class="fa fa-check text-info"></i> <?= $d->nama_mekanisme ?></li> 

                            @endforeach
                        </ol>

                        <div class="card-header bg-warning">
                            <h3 class="m-b-0 text-white">Proses Pengerjaan</h3>
                            <p class="card-tex text-white">
                                Daftar proses yang menggambarkan tahapan pemrosesan pengajuan yang telah disetujui                 
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Proses</th>
                                            <th>Deskripsi</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php $n = 1; ?>
                                        @foreach($items['soplayanan'] as $d)
                                        <tr>
                                            <td><?= $n ?></td>
                                            <td><?= $d->nama_proses ?></td>
                                            <td><?= $d->deskripsi_proses ?></td>
                                        </tr>
                                        <?php $n++ ?>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-header bg-info">
                            <h3 class="m-b-0 text-white">Isian Pengajuan</h3>
                            <p class="card-tex text-white">
                                Daftar isian pada form pengajuan yang harus diisi oleh pemohon
                                untuk kemudian dikirim/diunggah bersama persyaratan lainnya adalah sebagai berikut : 
                            </p>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($items['formisian'] as $d) 
                                        <tr>
                                            <th><?= $d->nama_formisian ?></th>
                                            <td><?= $d->ket_form ?></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--<div class="page-break"></div>-->

                        <div class="card-header bg-primary">
                            <h3 class="m-b-0 text-white">Dokumen Untuk Diupload</h3>
                            <p class="card-tex text-white">
                                Daftar dokumen yang harus diupload oleh pemohon                    
                            </p>                


                        </div>
                        <div class="card-body">
                            <ol class="list-icons">
                                @foreach($items['dokumenupload'] as $d)
                                <li><i class="fa fa-check text-info"></i> <?= $d->nama_dokumen ?></li>

                                @endforeach
                            </ol>
                        </div>
                        <div class="card-header bg-danger">
                            <h3 class="m-b-0 text-white">Status Pengajuan</h3>
                            <p class="card-tex text-white">
                                Daftar status dari pengajuan yang dilakukan pemohon                 
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($items['statuspengajuan'] as $d)
                                        <tr>
                                            <th><?= $d->nama_pengajuan ?></th>
                                            <td><?= $d->keterangan ?></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-header bg-dark">
                            <h3 class="m-b-0 text-white">Formulir</h3>
                            <p class="card-tex text-white">Daftar formulir yang harus diisi oleh pemohon untuk kemudian dikirim bersama persyaratan lainnya ke Disdukcapil</p>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($items['formulir'] as $d)
                                        <tr>
                                            <th><?= $d->nama_formulir ?></th>
                                            <td><?= $d->deskripsi_formulir ?></td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-header bg-success">
                            <h3 class="m-b-0 text-white">Dokumen Kependudukan Yang Dapat Didownload</h3>
                            <p class="card-tex text-white">
                                Daftar dokumen kependudukan yang dapat didownlod oleh pemohon ketika pengajuan selesai diproses                 
                            </p>
                        </div>
                        <div class="card-body">
                            <ol class="list-icons">
                                @foreach($items['dokumenlayanan'] as $d)
                                <li><i class="fa fa-check text-info"></i> <?= $d->nama_dok_download ?><br><?= $d->dokumen_deskripsi ?></li>

                                @endforeach
                            </ol>
                        </div>
                        <br>
                        <br>
                        Scan QR Code di bawah ini utk akses langsung ke halaman web kami
                        <?php
                        $image = QrCode::format('png')
                                ->merge(public_path('img\logo_jyw.png'), 0.2, true)
                                ->size(800)->errorCorrection('H')
                                ->generate('http://online.disdukcapil.jayawijayakab.go.id:88');
                        ?>

                        <div style="text-align: center; color: #005983">
                            <img width="100" src="data:image/png;base64, {!! base64_encode($image) !!} ">
                            <h4 class="text-center">
                                Salam GISA 
                                <br>
                                Gerakan Indonesia Sadar Administrasi Penduduk 
                                <br>
                                Kami Melayani Sepenuh Hati 
                                <br>
                                Untuk Membahagiakan Masyarakat 
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

