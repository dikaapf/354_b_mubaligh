@extends('layouts.tpl_admin')
@section('title')
Registrasi Operator | Layanan Online Adminduk Kabupaten Jayawijaya
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
                            <h5 class="card-title">Edit Operator</h5>
                            <h6 class="card-subtitle">Silahkan Isikan form ubah operator baru dengan data yang sesuai </h6>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">Formulir Ubah Operator</h4>
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                         {{ session('status') }}

                                    </div>
                                    @endif
                                    {!! Form::model($operator, [
                                    'method' => 'PATCH',
                                    'url' => ['updateoperator', Crypt::encrypt($operator->id)],
                                    'class' => 'form-horizontal','novalidate' 
                                    ]) !!}
                                    <div class="form-body">
                                        <h3 class="box-title">Data Operator</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Username <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('email', null, ['class' => 'form-control','readonly','required data-validation-required-message'=>'Wajib diisi']) !!}

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Nama Operator <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('name', null, ['class' => 'form-control','required data-validation-required-message'=>'Wajib diisi']) !!}

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Nomor HP/Whatsapp <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('no_hp', null, ['class' => 'form-control','maxlength'=>'12','required data-validation-required-message'=>'Wajib diisi','required data-validation-containsnumber-regex'=>'(\d)+', 'data-validation-containsnumber-message'=>'Isian Angka', 'placeholder'=>'No WA dengan format 08xxxx']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Alamat <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::textarea('alamat', null, ['rows'=>'5','class' => 'form-control','placeholder'=>'Isikan alamat yang aktif']) !!}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group"> 
                                                    <h5>Unit Kerja / Seksi / Bidang <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('unit_kerja', null, ['class' => 'form-control','required data-validation-required-message'=>'Wajib diisi']) !!}

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Jabatan <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('job_title', null, ['class' => 'form-control','required data-validation-required-message'=>'Wajib diisi']) !!}

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Status Operator <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::select('status_operator',['0'=>'Non Aktif','1'=>'Aktif'] ,null, ['class' => 'form-control','required data-validation-required-message'=>'Wajib diisi']) !!}

                                                    </div>
                                                </div>
                                                <h5> <input  type="checkbox"  id='ubahPassword' class="js-switch" data-color="#cd0a0a" data-size="small"/> &nbsp;Ubah Password <span class="text-danger">*</span></h5>
                                                <div id='passwordform'>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <input  id="passwordoperator"  type="password" name="password" class="form-control"  minlength="6" placeholder="Password minimal 6 karakter" > </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Ulangi Password <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="repasswordoperator" type="password" name="password2" data-validation-match-match="password" class="form-control"  placeholder="Ulangi password"> </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <!-- End Row -->  

                        </div>
                    </div>

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
        var checkbox = $("#ubahPassword");
        var hidden = $("#passwordform");
        hidden.hide();
        $('#passwordoperator').prop('required', false); //to remove required
        $('#repasswordoperator').prop('required', false); //to remove required
        checkbox.change(function () {
            if (checkbox.is(':checked')) {
                hidden.show();
                $('#passwordoperator').attr("required", "required"); //to add required
                $('#repasswordoperator').attr("required", "required"); //to add required  
            } else {
                hidden.hide();
                $("#passwordoperator").val('');
                $("#repasswordoperator").val('');
                $('#passwordoperator').prop('required', false); //to remove required
                $('#repasswordoperator').prop('required', false); //to remove required
            }
        });

    })

</script>
@endsection