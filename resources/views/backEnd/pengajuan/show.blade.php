@extends('layouts.tpl_operator')
@section('title')
Detail Pengajuan | Layanan Online Adminduk Kabupaten Jayawijaya
@stop
@section('content')
<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

//echo "<pre>", print_r($pengajuan_id), "</pre>";
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
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if (session('status'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"> <span aria-hidden="true">&times;</span> </button>
                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                         {{ session('status') }}

                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <?php
                                $image = QrCode::format('png')
                                        ->merge(public_path('img\logo_jyw.png'), 0.2, true)
                                        ->size(800)->errorCorrection('H')
                                        ->generate($pengajuan->nomor_pengajuan);
                                ?>
                                <img width="60%" src="data:image/png;base64, {!! base64_encode($image) !!} ">

                            </div>
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
                        <div class="col-lg-6 col-md-12">

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
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>NIK Pemohon</td>
                                                    <td><?= ($pengajuan->email) ?></td>

                                                </tr>
                                                <tr>
                                                    <td>Nama Pemohon</td>
                                                    <td><?= ($pengajuan->name) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>No KK</td>
                                                    <td><?= ($pengajuan->no_kk) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>No HP</td>
                                                    <td><?= ($pengajuan->no_hp) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <!--<a href="<?= url('user' . '/' . $pengajuan->user_id . '/detail') ?>" class="btn btn-info btn-sm btn-rounded"><i class="icon-user-following"></i>  Detail User</a>-->
                                                    </td>
                                                    <td colspan="">
                                                        <a class="btn btn-facebook btn-block btn-lg btn-rounded _kirimPesan"  data-no_hp="<?= $pengajuan->no_hp ?>"  href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Balas Pesan "><i class="fa fa-envelope"></i>  Kirim pesan melalui SMS</a>

                                                        <div class="modal fade bs-example-modal-lg" id="myLargeModalLabel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4>Kirim Pesan Singkat (SMS)</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {!! Form::open(['url' => 'pesan', 'class' => 'form-horizontal','id'=>'form_pesan']) !!}

                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Nomor Tujuan:</label>
                                                                            <input type="text" class="form-control" name="destinationnumber" readonly="" id="destNumber">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">Isi Pesan:</label>
                                                                            <textarea class="form-control" name="textdecoded"></textarea>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-facebook btn-sm">Kirm Pesan</button>
                                                                        </div>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                    </td>
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

    </div>
    <div class="row">
        <!-- Column -->
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
                            <thead>
                                <tr class="text-center">
                                    <th>Kolom</th>
                                    <th>Isian</th>
                                </tr>
                            </thead>
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

                    @else
                    <span class="card-title text-danger">
                        Layanan ini tidak mensyaratkan harus mengirimkan dokumen fisik persyaratan ke Disdukcapil sebelum pengajuan dapat diproses lebih lanjut

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

    </div>


    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex ">
                        <div>
                            <h4 class="card-title">Aksi Terkait Pengajuan</h4>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?= url('data-pengajuan/cetak') . '/' . Crypt::encrypt($pengajuan_id) . '/pdf?=download' ?>" class="btn btn-block btn-purple btn-lg text-center text-white"><i class="icon-printer"></i> <span class="card-title"> Cetak Detail</span></a>

                        </div>
                        <div class="col-md-4">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#responsive-modal" class="btn btn-block btn-primary btn-lg text-center text-white"><i class="icon-action-redo"></i> <span class="card-title"> Update Status Pengajuan </span></a>

                        </div>
                        <div class="col-md-4">
                            <!--<a href="javascript:void(0)" id="_btnProc"  data-status_id="<?= $pengajuan->status_pengajuan ?>" class="btn btn-block btn-facebook btn-lg text-center text-white"><i class="icon-energy"></i> <span class="card-title"> Update Proses</span></a>-->
                            <a href="javascript:void(0)"  data-status_id="<?= $pengajuan->status_pengajuan ?>" class="btn btn-block btn-facebook btn-lg text-center text-white _updateProcess"><i class="icon-action-redo"></i> <span class="card-title"> Update Proses Pengerjaan</span></a>

                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        @if(count($dokumenlayanan)>0)
                        <div class="col-md-4">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#responsive-modal4"  class="btn btn-block btn-youtube btn-lg text-center text-white"><i class="fa fa-upload"></i> <span class="card-title"> Upload Dokumen Download</span></a>

                        </div>
                        @endif

                        @if($pelayanan->ambil_dok==1)

                        <div class="col-md-4">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#responsive-modal3" class="btn btn-block btn-flickr btn-lg text-center text-white"><i class="fa fa-file"></i> <span class="card-title"> Update Status Pengambilan</span></a>

                        </div>
                        @endif
                        @if($pelayanan->kirim_syarat==1)
                        <div class="col-md-4">
                            <a href="<?= url('data-pengajuan/update') . '/' . Crypt::encrypt($pengajuan_id) . '/terima-syarat' ?>" class="btn btn-block btn-googleplus btn-lg text-center text-white"><i class="fa fa-folder-open"></i> <span class="card-title"> Update Terima Persyaratan</span></a>

                        </div>
                        @endif
                    </div>
                </div>

                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            {!! Form::open([
                            'method' => 'PATCH',
                            'url' => ['data-pengajuan/status', Crypt::encrypt($pengajuan_id)],
                            'class' => 'form-horizontal']) !!}

                            <div class="modal-header">
                                <h4 class="modal-title">Update Status Pengajuan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <?php
                                    if ($pengajuan->status_pengajuan == 1) {
                                        $list = [
                                            '' => 'Pilih status pengajuan',
                                            '2' => 'Pengajuan disetujui untuk di proses',
                                            '3' => 'Pengajuan diproses',
                                            '4' => 'Pengajuan dibatalkan',
                                        ];
                                    } else if ($pengajuan->status_pengajuan == 2) {
                                        $list = [
                                            '' => 'Pilih status pengajuan',
                                            '3' => 'Pengajuan diproses',
                                            '4' => 'Pengajuan dibatalkan',
                                            '5' => 'Pengajuan Selesai',
                                        ];
                                    } else if ($pengajuan->status_pengajuan == 3) {
                                        $list = [
                                            '' => 'Pilih status pengajuan',
                                            '5' => 'Pengajuan Selesai',
                                        ];
                                    } else if ($pengajuan->status_pengajuan == 5) {
                                        $list = [
                                            '' => 'Telah selesai diproses',
                                        ];
                                    }
                                    ?>
                                    <label for="recipient-name" class="control-label">Status Pengajuan:</label>
                                    {!! Form::select('status_pengajuan', $list, null, ['class' => 'form-control',  'required','id'=>'pilstatus']) !!}
                                </div>

                                <div id="statproc">
                                    <div class="form-group" >
                                        <label for="recipient-name" class="control-label">Nama Proses:</label>
                                        {!! Form::select('nama_proses', $list, null, ['class' => 'form-control','id'=>'nmproses']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Petugas/Pejabat yang memproses:</label>
                                        {!! Form::text('diproses_oleh', null, ['class' => 'form-control','required']) !!}
                                        <span class="help">Diisi pejabat verifikator / pejabat yang berwenang</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Catatan:</label>
                                    <textarea required="" class="form-control" name="catatan" id="message-text"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Update Status</button>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
                <div id="responsive-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            {!! Form::open([
                            'method' => 'PATCH',
                            'url' => ['data-pengajuan/proses', Crypt::encrypt($pengajuan_id)],
                            'class' => 'form-horizontal']) !!}

                            <div class="modal-header">
                                <h4 class="modal-title">Update Proses Pengajuan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Nama Proses:</label>
                                    {!! Form::select('nama_proses', listProsesPengajuan($pelayanan->id), null, ['class' => 'form-control']) !!}
                                    {!! Form::hidden('status_pengajuan', $pengajuan->status_pengajuan, ['class' => 'form-control','required']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Petugas/Pejabat yang memproses:</label>
                                    {!! Form::text('diproses_oleh', null, ['class' => 'form-control','required']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Catatan:</label>
                                    <textarea class="form-control" name="catatan" id="message-text" required=""></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Update Status</button>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>

                <div id="responsive-modal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            {!! Form::open([
                            'method' => 'PATCH',
                            'url' => ['data-pengajuan/ambildok', Crypt::encrypt($pengajuan_id)],
                            'class' => 'form-horizontal']) !!}

                            <div class="modal-header">
                                <h4 class="modal-title">Update Status Pengambilan Dokumen</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Tanggal Pengambilan:</label>

                                    <div class="input-group">
                                        <input type="text" name="tanggal_ambil" required="" class="form-control" id="datepicker-autoclose" value="<?= date('Y-m-d') ?>" placeholder="yyyy-mm-dd">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Diambil oleh:</label>
                                    {!! Form::text('ambil_oleh', null, ['class' => 'form-control',  'required']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Jenis Dokumen:</label>
                                    {!! Form::select('jenis_dokumen', listDokumen(), null, ['class' => 'form-control',  'required']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Catatan:</label>
                                    <textarea required="" class="form-control" name="catatan" id="message-text"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Update Status Pengajuan</button>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
                <div id="responsive-modal4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            {!! Form::open([

                            'url' => ['data-pengajuan/uploaddok', Crypt::encrypt($pengajuan_id)],
                            'class' => 'form-horizontal', 'files'=>'true']) !!}

                            <div class="modal-header">
                                <h4 class="modal-title">Upload Dokumen Layanan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">



                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Pilih Dokumen (harus berupa pdf):</label><br>
                                    <input type="file" name="link_file" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Nama Dokumen / Keterangan:</label>
                                    <select class="form-control" name="deskripsi_upload">
                                        @foreach($dokumenlayanan as $d)
                                        <option value="<?= $d->nama_dok_download ?>"><?= $d->nama_dok_download ?></option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Upload</button>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
<a href="javascript:void(0)" class="_test">test</a>
@endsection
@section('scripts')

<script type="text/javascript">

    $(document).ready(function () {
        $('._kirimPesan').click(function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();

            if (e.handled !== true) {
                var no_hp = ($(this).data('no_hp'));
                var user_id = ($(this).data('user_id'));
                $('#myLargeModalLabel').modal().show();
                $('#destNumber').val(no_hp);
                $('#user_id').val(user_id);
            }

        });

        $('form#form_pesan').on('submit', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?= url('/sms/balaspesan') ?>",
                type: "POST",
                async: false,
                data: $("#form_pesan").serialize(),
                success: function (data) {
//                    $('#data_bawahan').html(data);
                    if (data == 1) {
                        swal({
                            title: "Sip!.... OK,",
                            text: "Pesan terkirim",
                            type: "success",
                            allowOutsideClick: true,
                            confirmButtonClass: "btn_success",
                        });
                        $('#myLargeModalLabel').modal('hide');
                        location.reload();
                    } else {
                        swal({
                            title: "opps!!!,",
                            text: "Pesan gagal",
                            type: "error",
                            allowOutsideClick: true,
                            confirmButtonClass: "btn_danger",
                        });
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
//                        alert(jqXHR.status);
//                        alert(textStatus);
                    if (errorThrown == 'Unauthorized') {
                        alert('Sesi login anda berakhir, \nSilahkan login kembali');
                        location.reload();

                    }
                }
            });


        });
        $('#statproc').hide();
        $('#pilstatus').on('change', function () {
//            alert(this.value);

            if (this.value == 3) {
                $('#statproc').show();
            } else if (this.value == 4) {
                $('#statproc').remove();
            } else if (this.value == 5) {
                $('#statproc').remove();
            } else {
                $('#statproc').hide();
            }
        });
        $("._updateProcess").click(function () {
            var stat_data = $(this).data('status_id');
//            alert(stat_data);
            if (stat_data <= 2) {
                swal({
                    title: "Lanjutkan update proses?",
                    text: "Status Pengajuan Masih Belum diproses! Silahkan update status pengajuan menjadi Diproses",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Update Proses!",
                    closeOnConfirm: false
                }, function () {
                    swal("Lanjutkan proses update!", "Setelah update proses, status pengajuan secara otomatis akan diupdate menjadi Pengajuan Diproses.", "success");
                    $("#responsive-modal2").modal('show');
//                    return;
                });
            } else {
                $("#responsive-modal2").modal('show');
            }
        });
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });


    })

</script>
@endsection