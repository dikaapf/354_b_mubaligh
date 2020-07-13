@extends('layouts.tpl_operator')
@section('title')
Detail Pengguna | Layanan Online Adminduk Kabupaten Jayawijaya
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
                            <h5 class="card-title">Detail Pengguna</h5>
                            <h6 class="card-subtitle">Rincian Pengguna yang memiliki akses </h6>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <h5>{!! Form::label('ubah_data', 'Ubah Data ', ['class' => 'control-label']) !!} <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="checkbox" name="ubah_data"  class="js-switch" data-color="#cd0a0a" data-size="small"/> Apakah akan melakukan perubahan data pengguna<br>

                                    </div>
                                </div>
                                <form class="form-horizontal form-material">

                                    <div class="form-group">
                                        <label class="col-md-12">NIK</label>
                                        <div class="col-md-12">
                                            <input type="text" readonly="" value="<?= $user->email ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Nama Lengkap</label>
                                        <div class="col-md-12">
                                            <input type="text" readonly="" value="<?= $user->name ?>" class="form-control form-control-line" name="example-email" id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">No KK</label>
                                        <div class="col-md-12">
                                            <input type="text" readonly="" value="<?= $user->no_kk ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" readonly="" value="<?= $user->no_hp ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Alamat</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" readonly="" class="form-control form-control-line"><?= $user->alamat ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">

                            </div>

                        </div>

                    </div>

                    <!-- Row -->
                </div>
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
                            <h5 class="card-title">Data Pendukung</h5>
                            <!--<h6 class="card-subtitle">Rincian Pengguna yang memiliki akses </h6>-->
                        </div>

                    </div>
                    <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="popup-youtube btn btn-block btn-success" href="<?= asset($user->link_ktp) ?>"><i class="icon-credit-card"></i> Lihat Foto KTP</a>
                        </div>
                        <div class="col-md-3">
                            <a class="popup-gmaps btn-block btn btn-facebook" href="<?= asset($user->link_kk) ?>"><i class="icon-folder"></i> Lihat Foto KK</a>
                        </div>
                        <div class="col-md-3">
                            <a class="popup-gmaps btn btn-block btn-googleplus" href="<?= asset($user->link_ttd) ?>"><i class="fa fa-file"></i> Lihat Foto Tanda Tangan</a>
                        </div>
                        <div class="col-md-3">
                            <a class="popup-gmaps btn-block btn btn-purple" href="<?= asset($user->link_selfie) ?>"><i class="fa fa-camera"></i> Lihat Foto Selfie</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->  
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('scripts')

<script type="text/javascript">
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function () {
        new Switchery($(this)[0], $(this).data());
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $(document).ready(function () {

        $('#myTable').DataTable();
    })

</script>
@endsection