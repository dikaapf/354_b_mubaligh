@extends('layouts.tpl_admin')
@section('title')
Edit Kategori
@stop

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Administrator Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('/') ?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Edit Kategori</li>
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
                    <h5 class="card-title text-uppercase">Edit Kategori</h5>



                    {!! Form::model($kategori, [
                    'method' => 'PATCH',
                    'url' => ['kategori', $kategori->id],
                    'class' => 'form-horizontal'
                    ]) !!}

                    <div class="form-group {{ $errors->has('nama_kategori') ? 'has-error' : ''}}">
                        {!! Form::label('nama_kategori', 'Nama Kategori: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('nama_kategori', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('nama_kategori', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('deskripsi') ? 'has-error' : ''}}">
                        {!! Form::label('deskripsi', 'Deskripsi Kategori: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::textarea('deskripsi', null, ['class' => 'form-control','rows'=>'3']) !!}
                            {!! $errors->first('deskripsi', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('flag_status') ? 'has-error' : ''}}">
                        {!! Form::label('flag_status', 'Flag Status: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::select('flag_status',['1'=>'Aktif','0'=>'Tidak Aktif'], null, ['class' => 'form-control']) !!}
                            {!! $errors->first('flag_status', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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