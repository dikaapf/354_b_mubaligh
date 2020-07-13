@extends('backLayout.app')
@section('title')
Create new Pengajuan
@stop

@section('content')

    <h1>Create New Pengajuan</h1>
    <hr/>

    {!! Form::open(['url' => 'pengajuan', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                {!! Form::label('user_id', 'User Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('jenislayanan_id') ? 'has-error' : ''}}">
                {!! Form::label('jenislayanan_id', 'Jenislayanan Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('jenislayanan_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('jenislayanan_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status_pengajuan') ? 'has-error' : ''}}">
                {!! Form::label('status_pengajuan', 'Status Pengajuan: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('status_pengajuan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('status_pengajuan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('catatan') ? 'has-error' : ''}}">
                {!! Form::label('catatan', 'Catatan: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('catatan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('catatan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('process_by') ? 'has-error' : ''}}">
                {!! Form::label('process_by', 'Process By: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('process_by', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('process_by', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
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

@endsection