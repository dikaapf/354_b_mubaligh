@extends('layouts.tpl_operator')
@section('title')
Data Pengguna
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-user-follow font-green"></i>
                    <span class="caption-subject font-green bold uppercase">REGISTRASI PENGGUNA</span>
                </div>

            </div>
            <div class="portlet-body">
                @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
                @endif
                <!-- BEGIN FORM-->

                {!! Form::open(['url' => 'adduser', 'class' => 'form-horizontal', 'id'=>'form_sample_2']) !!}

                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">Nama Lengkap
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="name" /> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Email
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="email" /> </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">Kata sandi
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="password" class="form-control" name="password" /> </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">NIP / No ID Karyawan
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="nip" /> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">NIK
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="nik" /> </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">Instansi
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="instansi" /> </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">Unit Kerja
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="unit_kerja" /> </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">Jabatan
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="jabatan" /> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">No Telp/HP
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="no_telp" /> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Status
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <select class="form-control select2me" name="status_user">
                                <option value="">Select...</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">Submit</button>
                            <button type="button" class="btn default">Cancel</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>

@endsection
@section('scripts')

<script type="text/javascript">
    var FormValidation = function () {


        // validation using icons
        var handleValidation2 = function () {
            // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form2 = $('#form_sample_2');
            var error2 = $('.alert-danger', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    status_user: {
                        required: true
                    },
                    name: {
                        minlength: 2,
                        required: true,
                    },
                    instansi: {
                        minlength: 2,
                        required: true,
                    },
                    jabatan: {
                        minlength: 2,
                        required: true,
                    },
                    unit_kerja: {
                        minlength: 2,
                        required: true,
                    },
                    password: {
                        minlength: 2,
                        required: true,
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    no_telp: {
                        required: true,
                        number: true
                    },
                    nip: {
                        required: true,
                        digits: true
                    },
                    nik: {
                        required: true,
                        digits: true
                    },
                    creditcard: {
                        required: true,
                        creditcard: true
                    },
                },
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },
                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },
                highlight: function (element) { // hightlight error inputs
                    $(element)
                            .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
                },
                unhighlight: function (element) { // revert the change done by hightlight

                },
                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },
                submitHandler: function (form) {
                    success2.show();
                    error2.hide();
                    form[0].submit(); // submit the form
                }
            });


        }





        return {
            //main function to initiate the module
            init: function () {

                handleValidation2();

            }

        };

    }();

    jQuery(document).ready(function () {
        FormValidation.init();
    });

</script>
@endsection