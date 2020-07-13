@extends('layouts.tpl_admin')
@section('title')
Create new Pengajar
@stop

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Tambah pengajar</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('/') ?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Pengajar</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box -->
    <!-- ============================================================== -->
    <!-- .row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">Menambahkan pengajar baru</h5>
                    {!! Form::open(['url' => 'pengajar', 'class' => 'form-horizontal']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                {!! Form::label('name', 'Nama Lengkap: ', ['class' => 'col-sm-6 control-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-6 control-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('job_desc') ? 'has-error' : ''}}">
                                {!! Form::label('job_desc', 'Profesi/Pekerjaan: ', ['class' => 'col-sm-6 control-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::text('job_desc', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('job_desc', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('no_ktp') ? 'has-error' : ''}}">
                                {!! Form::label('no_ktp', 'No. KTP: ', ['class' => 'col-sm-6 control-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::text('no_ktp', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('no_ktp', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : ''}}">
                                {!! Form::label('no_hp', 'No. HP: ', ['class' => 'col-sm-6 control-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::text('no_hp', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('no_hp', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
                                {!! Form::label('alamat', 'Alamat: ', ['class' => 'col-sm-6 control-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('status_pengajar') ? 'has-error' : ''}}">
                                {!! Form::label('status_pengajar', 'Status Pengajar: ', ['class' => 'col-sm-6 control-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('status_pengajar',['1'=>'Aktif','0'=>'Tidak aktif'], null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('status_pengajar', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>







                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>


@endsection