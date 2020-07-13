@extends('layouts.tpl_login')
@section('title')
Login Penduduk | Layanan Online Adminduk Kabupaten Jayawijaya
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card text-center">

                <div class="card-body">
                    <h4 class="card-title">SISTEM LAYANAN ONLINE ADMINISTRASI KEPENDUDUKAN</h4>
                    <H5>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KABUPATEN JAYAWIJAYA </H5>
                </div>

            </div>
            <!-- Card -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Login Penduduk</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <h6 class="card-subtitle">Login dengan memasukkan NIK serta password yang sesuai </h6>
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label text-right col-md-3 ">NIK</label>
                                            <div class="col-md-9">
                                                <input id="email" placeholder="Isikan NIK" type="text" class="form-control"  name="email" value="{{ old('email') }}" required autofocus>
                                                <!--<small class="form-control-feedback"> Isikan NIK anda </small>--> 

                                                @if ($errors->has('email'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>


                                        </div>
                                        <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="control-label text-right col-md-3 ">Password</label>
                                            <div class="col-md-9">
                                                <input id="email" type="password" class="form-control"  name="password" value="{{ old('password') }}" required autofocus>
                                                <!--<small class="form-control-feedback"> Isi kata sandi </small>--> 

                                                @if ($errors->has('email'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title text-info text-center">Belum mendaftar sebagai user?<br><br><br>


                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <a class="btn btn-block btn-primary" href="<?= url('/register') ?>"><i class="fa fa-user-plus"></i> &nbsp;Daftar User Baru</a>

                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">

                                                    <a class="btn btn-block btn-warning" href="<?= url('/bantuan') ?>"> <i class="fa fa-file-archive-o"></i> &nbsp;Bantuan</a>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-block btn-success"><i class="fa  fa-external-link"></i> Login</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
