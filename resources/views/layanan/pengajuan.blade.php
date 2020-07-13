@extends('layouts.tpl_login')
@section('title')
Detail Pelayanan | Layanan Online Adminduk Kabupaten Jayawijaya
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                         {{ session('status') }}

                    </div>

                    @endif
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Pengajuan Baru</h5>
                            <h6 class="card-subtitle">Isilah form pengajuan dengan data-data yang benar </h6>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xlg-4">
                            <div class="card card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-4 col-lg-3 text-center">
                                        <a href="app-contact-detail.html"><img src="<?= asset('/sig') ?>/assets/images/users/1.jpg" alt="user" class="img-circle img-fluid"></a>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <h3 class="box-title m-b-0"><?= $pelayanan->nama_layanan ?></h3> <small></small>
                                        <address>
                                            <?= $pelayanan->deskripsi ?>
                                        </address>
                                    </div>
                                </div>

                            </div>

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

    {!! Form::open(['url' => 'pengajuan', 'class' => 'form-horizontal', 'files'=>'true','novalidate']) !!}

    <div class="row">

        <div class="col-lg-12">
            <div class="card border-info">
                <div class="card-header bg-dark">
                    <h4 class="m-b-0 text-white">Isian </h4>
                    <p class="card-tex text-white">
                        Daftar isian pada form pengajuan yang harus diisi oleh pemohon
                    </p>


                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" name="user_id"  class="form-control"  value="<?= Auth::guard('web')->user()->id ?>"> 
                        <input type="hidden" name="jenispelayanan_id"  class="form-control" value="<?= $pelayanan->id ?>"> 
                        <?php
//                        print_r($pelayanan->id);
                        ?>
                        <table class="table table-bordered">
                            <tbody>
                                @foreach($formisian as $d)
                                <tr>
                                    <th>

                                        <input type="text" name="form_isian[]" readonly="" value="<?= $d->nama_formisian ?>" class="form-control" required data-validation-required-message="Wajib diisi" placeholder="">



                                    </th>
                                    <td>
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="text" name="data_isian[]"  class="form-control" required data-validation-required-message="Wajib diisi" placeholder="<?= $d->ket_form ?>"> 

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- End Row -->  

        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card border-info">
                <div class="card-header bg-primary">
                    <h4 class="m-b-0 text-white">Upload Dokumen</h4>
                    <p class="card-tex text-white">
                        Uploadlah dokumen yang disyaratkan oleh layanan ini dengan memfoto dokumen tersebut                    
                    </p>


                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <tbody>
                                @foreach($dokumenupload as $d)
                                <tr>
                                    <th>
                                        <h5>FOTO <?= strtoupper($d->nama_dokumen) ?> <span class="text-danger">*</span></h5>

                                        <input type="hidden" name="form_upload[]" readonly="" value="<?= $d->nama_dokumen ?>" class="form-control" required data-validation-required-message="Wajib diisi" placeholder="">


                                    </th>

                                    <td>
                                        <div class="form-group">

                                            <div class="controls">
                                                <input type="file" name="data_upload[]" class="form-control" required> </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                            <h5 class="card-title">Pengiriman Berkas Fisik Pengajuan</h5>
                            <h6 class="card-subtitle">Kewajiban pemohon mengirimkan dokumen fisik persyaratan pengajuan </h6>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-primary">


                                <div class="card-body">
                                    <label >
                                        <input  readonly="" type="checkbox" <?= $pelayanan->kirim_syarat == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/>
                                        <span <?= $pelayanan->kirim_syarat == 0 ? 'class="card-subtitle"' : '' ?>>Pemohon harus mengirimkan dokumen fisik persyaratan ke Disdukcapil sebelum pengajuan dapat diproses lebih lanjut</span>
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
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Pengambilan Dokumen</h5>
                            <h6 class="card-subtitle">Pilihlah opsi pengambilan dokumen </h6>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-primary">


                                <div class="card-body">

                                    <div class="form-group">
                                        <label >
                                            <input  readonly="" type="checkbox" <?= $pelayanan->ambil_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/>
                                            <span <?= $pelayanan->ambil_dok == 0 ? 'class="card-subtitle"' : '' ?>>Pemohon dapat mengambil dokumen kependudukan sendiri</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label >
                                            <input readonly="" type="checkbox" <?= $pelayanan->kirim_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/>
                                            <span <?= $pelayanan->kirim_dok == 0 ? 'class="card-subtitle"' : '' ?>>Dokumen kependudukan dapat dikirimkan kepada pemohon via ekspedisi</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label >
                                            <input readonly="" type="checkbox" <?= $pelayanan->info_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/>
                                            <span <?= $pelayanan->info_dok == 0 ? 'class="card-subtitle"' : '' ?>> Hasil Layanan diinformasikan melalui pesan SMS/Whatsapp</span>
                                        </label>
                                    </div>




                                </div>
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-block btn-info">Daftar</button>
                            </div>
                        </div>

                        <!-- Row -->
                    </div>
                </div>
                <!-- End Row -->  

            </div>
        </div>

    </div>
    {!! Form::close() !!}


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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $('._displaymap').on('click', function (e) {
            //            alert();
            //        $('body').delegate('._mtransaksi', 'click', function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $.ajax({
                url: "<?= url('/petajyw') ?>",
                type: "POST",
                async: false,
                //                    dataType: 'json',
                success: function (data) {
                    $('#pmapper_result').html(data);

                },
                error: function (data) {
                    alert("fail");
                }
            });

        });

    })

</script>
@endsection