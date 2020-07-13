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
                        <div class="card-header bg-info">
                            <h4 class="m-b-0 text-white">Pengaturan Data Instansi</h4>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card ">

                                <div class="card-body">
                                    @if (session('status'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                         {{ session('status') }}

                                    </div>
                                    @endif
                                    {!! Form::model($instansi, [
                                    'method' => 'PATCH',
                                    'files'=>'true',
                                    'url' => ['updateinstansi', Crypt::encrypt($instansi->id)],
                                    'class' => 'form-horizontal',
                                    'novalidate'
                                    ]) !!}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <h5>Kode Propinsi <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                {!! Form::text('no_prop', null, ['class' => 'form-control','required','data-validation-required-message'=>'Isian Angka','maxlength'=>'2','data-validation-containsnumber-regex'=>'(\d)+']) !!}

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <h5>Kode Kabupaten <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                {!! Form::text('no_kab', null, ['class' => 'form-control','required','data-validation-required-message'=>'Isian Angka','maxlength'=>'2','data-validation-containsnumber-regex'=>'(\d)+']) !!}

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Nama Propinsi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('nama_propinsi', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Nama Kabupaten <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('nama_kabupaten', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <h5>No Telpon<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('no_telp', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <h5>Nama Kepala Dinas<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('nama_kadis', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <h5>NIP Kadis <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('nip_kadis', null, ['class' => 'form-control','required','data-validation-required-message'=>'Isian Angka','maxlength'=>'18','data-validation-containsnumber-regex'=>'(\d)+']) !!}

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <h5>Slogan Header Aplikasi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('slogan_header', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Nama Pemerintah<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('nama_pemerintah', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <h5>Nama Dinas <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('nama_dinas', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Alamat<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('alamat', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <h5>Alamat Website<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('alamat_website', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <h5>No HP/Whatsapp<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::text('no_wa', null, ['class' => 'form-control','required','data-validation-required-message'=>'Wajib isi']) !!}

                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="col-lg-12 m-b-20"><img src="<?= asset($instansi->link_logo) ?>" class="img-responsive radius" /></div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <h5>Logo <span class="text-danger">*</span></h5>
                                                            <div class="controls">

                                                                <input type="file" name="link_logo" class="form-control"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="col-lg-12 m-b-20 bg-dark"><img src="<?= asset($instansi->logo_index) ?>" class="img-responsive radius" /></div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <h5>Logo Index<span class="text-danger">*</span></h5>
                                                            <div class="controls ">

                                                                <input type="file" name="logo_index" class="form-control"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-info">Simpan</button>
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
