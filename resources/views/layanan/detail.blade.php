@extends('layouts.tpl_login')
@section('title')
Rincian Layanan | Layanan Online Adminduk Kabupaten Jayawijaya
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
                            <h5 class="card-title">Detail Layanan</h5>
                            <h6 class="card-subtitle">Detail terkait layanan termasuk syarat, mekanisme, formulir, isian, dan lain-lain </h6>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xlg-4">
                            <div class="card card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-4 col-lg-3 text-center">
                                        <a href="app-contact-detail.html"><img src="<?= asset($pelayanan->link_gambar) ?>" alt="user" class="img-circle img-fluid"></a>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <h3 class="box-title m-b-0"><?= $pelayanan->nama_layanan ?></h3> <small></small>
                                        <address>
                                            <?= $pelayanan->deskripsi ?>
                                        </address>
                                    </div>
                                </div>

                            </div>
                            <a href="<?= url("/layanan/$pelayanan->id/pengajuan") ?>" class="btn btn-block waves-effect waves-light btn-rounded btn-primary"><i class="fa fa-plus"></i> Buat pengajuan baru</a>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-white bg-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Jam Pelayanan</h4></div>
                                <div class="card-body">
                                    <ul>
                                        <li>Jam pelayanan pada hari kerja adalah 08:00 - 14:00</li>
                                        <li>Untuk pengajuan layanan masih dapat dilakukan, silahkan pilih jenis layanan yang tersedia, dan berkas akan diproses pada hari/jam kerja berikutnya.</li>
                                    </ul>
                                </div>
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
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Data Layanan</h5>
                            <h6 class="card-subtitle">Data terkait layanan ini </h6>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-primary">

                                <div class="card-header bg-primary">
                                    <h4 class="m-b-0 text-white">Dokumen Petunjuk</h4></div>
                                <div class="card-body">
                                    <h3 class="card-title"></h3>
                                    <p class="card-text">Petunjuk lengkap tentang pengajuan <?= $pelayanan->nama_layanan ?> dapat didownload dengan menekan tombol berikut:</p>
                                    <a href="<?= url('data-layanan/' . Crypt::encrypt($pelayanan->id) . '/petunjuk') ?>" class="btn btn-facebook"><i class="fa fa-download"></i>  &nbsp;Download Petunjuk</a>
                                    <hr>
                                    <div> 
                                        <h5 class="card-title">Dokumen Fisik Persyaratan</h5>
                                    </div>
                                    <label >
                                        <input  readonly="" type="checkbox" <?= $pelayanan->kirim_syarat == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/>
                                        <span <?= $pelayanan->kirim_syarat == 0 ? 'class="card-subtitle"' : '' ?>>Pemohon harus mengirimkan dokumen fisik persyaratan ke Disdukcapil sebelum pengajuan dapat diproses lebih lanjut</span>
                                    </label>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-primary">

                                <div class="card-body">
                                    <div>
                                        <h5 class="card-title">Pengambilan Dokumen Kependudukan</h5>
                                    </div>

                                    <label >
                                        <input  readonly="" type="checkbox" <?= $pelayanan->ambil_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/>
                                        <span <?= $pelayanan->ambil_dok == 0 ? 'class="card-subtitle"' : '' ?>>Pemohon dapat mengambil dokumen kependudukan sendiri</span>
                                    </label>
                                    <label >
                                        <input readonly="" type="checkbox" <?= $pelayanan->kirim_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/>
                                        <span <?= $pelayanan->kirim_dok == 0 ? 'class="card-subtitle"' : '' ?>>Dokumen kependudukan dapat dikirimkan kepada pemohon via ekspedisi</span>
                                    </label>
                                    <hr>
                                    @if($pelayanan->ambil_dok==0)
                                    <div class="alert alert-info">
                                        <p>Pemohon tidak perlu mengambil dokumen kependudukan yang telah diterbitkan karena dapat dicetak sendiri.</p>

                                    </div>
                                    @endif

                                    @if($pelayanan->kirim_dok==0)
                                    <div class="alert alert-info">
                                        <p>Dokumen dapat di unduh pemohon setelah selesai diproses.</p>

                                    </div>
                                    @endif

                                    <div>
                                        <h5 class="card-title">Informasi Dokumen Kependudukan</h5>
                                    </div>

                                    <label >
                                        <input  readonly="" type="checkbox" <?= $pelayanan->info_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/>
                                        <span <?= $pelayanan->info_dok == 0 ? 'class="card-subtitle"' : '' ?>>Hasil Layanan diinformasikan melalui pesan SMS/Whatsapp</span>
                                    </label>



                                </div>
                            </div>


                        </div>
                        <!-- Row -->
                    </div>
                </div>
                <!-- End Row -->  

            </div>
        </div>

    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Persyaratan</h4>
                    <h6 class="card-subtitle">Daftar persyaratan yang harus dipenuhi oleh pemohon sebelum melakukan pengajuan layanan</h6>
                    <ul class="list-icons">
                        @foreach($persyaratan as $d)
                        <li><i class="fa fa-check text-info"></i> <?= $d->nama_persyaratan ?></li>

                        @endforeach
                    </ul>

                </div>
                <!-- End Row -->  

            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Mekanisme Pengajuan</h4>
                    <h6 class="card-subtitle">Mekanisme pengajuan yang harus dilakukan oleh pemohon terkait layanan ini </h6>
                    <ul class="list-icons">
                        @foreach($mekanisme as $d)
                        <li><i class="fa fa-check text-info"></i> <?= $d->nama_mekanisme ?></li>

                        @endforeach
                    </ul>

                </div>
            </div>

        </div>

    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h4 class="m-b-0 text-white">Formulir</h4>
                    <p class="card-tex text-white">Daftar formulir yang harus diisi oleh pemohon untuk kemudian dikirim bersama persyaratan lainnya ke Disdukcapil</p>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach($formulir as $d)
                                <tr>
                                    <th><?= $d->nama_formulir ?></th>
                                    <td><?= $d->deskripsi_formulir ?></td>
                                    <td>
                                        <a href="<?= url('formulir/' . Crypt::encrypt($d->id) . '/download') ?>" class="btn btn-facebook"><i class="fa fa-download"></i> Download</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-header bg-warning">
                    <h4 class="m-b-0 text-white">Proses Pengerjaan</h4>
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
                                @foreach($soplayanan as $d)
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
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-md-6">
            <div class="card border-info">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Isian Pengajuan</h4>
                    <p class="card-tex text-white">
                        Daftar isian pada form pengajuan yang harus diisi oleh pemohon
                    </p>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach($formisian as $d)
                                <tr>
                                    <th><?= $d->nama_formisian ?></th>
                                    <td><?= $d->ket_form ?></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h4 class="m-b-0 text-white">Dokumen Untuk Diupload</h4>
                    <p class="card-tex text-white">
                        Daftar dokumen yang harus diupload oleh pemohon                    
                    </p>                


                </div>
                <div class="card-body">
                    <ul class="list-icons">
                        @foreach($dokumenupload as $d)
                        <li><i class="fa fa-check text-info"></i> <?= $d->nama_dokumen ?></li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger">
                    <h4 class="m-b-0 text-white">Status Pengajuan</h4>
                    <p class="card-tex text-white">
                        Daftar status dari pengajuan yang dilakukan pemohon                 
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach($statuspengajuan as $d)
                                <tr>
                                    <th><?= $d->nama_pengajuan ?></th>
                                    <td><?= $d->keterangan ?></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-success">
                <div class="card-header bg-success">
                    <h4 class="m-b-0 text-white">Dokumen Kependudukan Yang Dapat Didownload</h4>
                    <p class="card-tex text-white">
                        Daftar dokumen kependudukan yang dapat didownlod oleh pemohon ketika pengajuan selesai diproses                 
                    </p>
                </div>
                <div class="card-body">
                    <ul class="list-icons">
                        @foreach($dokumenlayanan as $d)
                        <li><i class="fa fa-check text-info"></i> <?= $d->nama_dok_download ?></li>

                        @endforeach
                    </ul>
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