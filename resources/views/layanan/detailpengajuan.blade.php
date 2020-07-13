@extends('layouts.tpl_login')
@section('title')
Detail Pelayanan | Layanan Online Adminduk Kabupaten Jayawijaya
@stop
@section('content')
<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;
?>
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex ">
                        <div>
                            <h5 class="card-title">Detail Pengajuan</h5>
                            <h6 class="card-subtitle">Detail terkait Pengajuan </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card card-body bg-info">
                                <div class="row align-items-center">

                                    <div class="col-md-10 col-lg-11 text-white">
                                        <h3 class="box-title m-b-0 "><?= $pelayanan->nama_layanan ?></h3> <small></small>
                                        <address>
                                            <?= $pelayanan->deskripsi ?>
                                        </address>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="card ">

                                <div class="text-center">

                                    <?php
                                    $image = QrCode::format('png')
                                            ->merge(public_path('img\logo_jyw.png'), 0.2, true)
                                            ->size(800)->errorCorrection('H')
                                            ->generate($pengajuan->nomor_pengajuan);
                                    ?>
                                    <img width="80%" src="data:image/png;base64, {!! base64_encode($image) !!} ">

                                </div>

                            </div>

                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Nomor Pengajuan</td><td>:</td>
                                                    <td><?= ($pengajuan->nomor_pengajuan) ?></td>

                                                </tr>
                                                <tr>
                                                    <td>Tanggal Pengajuan</td><td>:</td>
                                                    <td><?= tgltime_angka($pengajuan->tanggal_pengajuan) ?></td>

                                                </tr>
                                                <tr>
                                                    <td>Status</td><td>:</td>
                                                    <td><?= getStatusPengajuan($pengajuan->status_pengajuan) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Catatan</td><td>:</td>
                                                    <td><?= ($pengajuan->catatan) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!-- End Row -->  

                            </div>
                        </div>


                    </div>
                    <!-- Row -->
                </div>
            </div>
            <!-- End Row -->  

        </div>
    </div>
    <div class="row">
        <!-- Column -->
         <div class="col-lg-6 col-md-12">
            <div class="card border-info">
                <div class="card-header bg-success">
                    <h4 class="m-b-0 text-white">Download Dokumen Kependudukan</h4>
                    <p class="card-tex text-white">
                        Daftar dokumen yang dapat didownload oleh pemohon untuk kemudian dicetak sendiri
                    </p>


                </div>
                <div class="card-body">


                    <ul class="list-icons">
                        @foreach($dokumenlayanan as $d)
                        <li><i class="fa fa-check text-info"></i> <?= $d->nama_dok_download ?></li>

                        @endforeach
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama File</th><th width='10%'>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($uploaddok as $doc)
                                <tr>
                                    <td><?= $doc->deskripsi_upload ?></td>
                                    <td><a href="<?= asset($doc->link_file) ?>" class="btn btn-facebook btn-sm"><i class="fa fa-download"></i> download</a></td>

                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Riwayat Pengajuan</h5>
                            <h6 class="card-subtitle">Daftar histori perubahan status pengajuan layanan </h6>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach($riwayat as $d)
                                <tr>
                                    <td><?= tgltime_angka($d->created_at) ?></td>
                                    <td><?= getStatusPengajuan($d->status_pengajuan) ?></td>
                                    <td><?= $d->catatan ?></td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- End Row -->  

            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Riwayat Proses Pengajuan</h5>
                            <h6 class="card-subtitle">Daftar histori proses pengerjaan pengajuan layanan </h6>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach($proses as $d)
                                <tr>
                                    <td><?= tgltime_angka($d->created_at) ?></td>
                                    <td><?= ($d->nama_proses) ?></td>
                                    <td><?= $d->catatan ?></td>
                                    <td><?= $d->diproses_oleh ?></td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- End Row -->  

            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card border-info">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Isian Pengajuan</h4>
                    <p class="card-tex text-white">
                        Daftar isian yang dimasukkan oleh pemohon pada form pengajuan
                    </p>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $dt = json_decode($pengajuan->data_isian);
//                            print_r($dt);
                        ?>

                        <table class="table table-bordered">
                            <tbody>
                                <?php
                                foreach ($dt as $keys) {
                                    foreach ($keys as $key => $value) {
                                        echo"<tr>";
                                        echo "<td>";
                                        print $key;
                                        echo "</td>";
                                        echo "<td>";
                                        print $value;
                                        echo "</td>";
                                        echo"<tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <!-- Column -->
        
        <div class="col-lg-6 col-md-12">
            <div class="card border-info">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Upload Dokumen</h4>
                    <p class="card-tex text-white">
                        Daftar dokumen yang harus diupload oleh pemohon pada form pengajuan
                    </p>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $dt = json_decode($pengajuan->data_upload);
//                            print_r($dt);
                        ?>

                        <table class="table table-bordered">
                            <tbody>
                                @foreach($dt as $keys)
                                @foreach($keys as $key => $value)
                                <tr class="zoom-gallery">
                                    <td><?= $key ?></td>
                                    <td width='30%'>
                                        <div class="col-md-12">
                                            <a data-source='<?= asset($value) ?>' href="<?= asset($value) ?>" data-toggle="tooltip" title="Foto <?= $key ?>" title=""> <img src="<?= asset($value) ?>" class="img-responsive" alt="img" /> </a>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card border-info">
                <div class="card-header bg-primary">
                    <h4 class="m-b-0 text-white">Pengiriman Berkas Fisik</h4>



                </div>
                <div class="card-body">
                    @if($pelayanan->kirim_syarat==1)
                    <span class="card-title text-dark">
                        Pemohon harus mengirimkan dokumen fisik persyaratan ke Disdukcapil sebelum pengajuan dapat diproses lebih lanjut 

                    </span>
                    <hr>
                    <br>
                    <span class="card-title">Kepada:</span><br>
                    <p>Dinas Kependudukan dan Pencatatan Sipil kabupaten Jayawijaya</p>
                    <p>Alamat:</p>
                    <p>Jalan Yos Sudarso Wamena, Papua. 99501</p>



                    @else
                    <span class="card-title text-danger">
                        Daftar dokumen yang harus diupload oleh pemohon pada form pengajuan

                    </span>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card border-info">
                <div class="card-header bg-primary">
                    <h4 class="m-b-0 text-white">Pengambilan Dokumen</h4>
                    <p class="card-tex text-white">
                        Opsi pengambilan dokumen
                    </p>


                </div>
                <div class="card-body">


                    @if($pelayanan->ambil_dok==1)
                    <span class="card-title text-dark">
                        Pemohon dapat mengambil dokumen kependudukan sendiri
                    </span>
                    <hr>
                    <div class="table-responsive">
                        @foreach($ambildok as $dd)
                        <table class="table table-striped">
                            <tr>
                                <td><span class="card-title">Tanggal Pengambilan</span></td>
                                <td width='60%'>
                                    <?= tgltime_angka($dd->tanggal_ambil) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="card-title">Diambil Oleh</span></td>
                                <td><?= $dd->ambil_oleh ?></td>
                            </tr>
                            <tr>
                                <td><span class="card-title">Jenis Dokumen</span></td>
                                <td><?= $dd->jenis_dok ?></td>
                            </tr>
                            <tr>
                                <td><span class="card-title">Catatan</span></td>
                                <td><?= $dd->catatan ?></td>
                            </tr>
                        </table>
                        @endforeach
                    </div>


                    @else
                    <span class="card-title text-danger">
                        Layanan ini tidak memiliki opsi pengambilan dokumen

                    </span>
                    @endif


                </div>
            </div>
        </div>
       

    </div>




</div>
@endsection
@section('scripts')

<script type="text/javascript">

    $(document).ready(function () {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });

    })

</script>
@endsection