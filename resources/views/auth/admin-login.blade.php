@extends('layouts.tpl_login')

@section('content') 
<div class="login-register" style="background-image:url(<?= asset('public/skin') ?>/assets/images/background/login-register.jpg);">
    <div class="login-box card">
        <div class="card-body">
            <img width="100%" src="<?= asset('public/img/logo_m.png') ?>">
            <form id="loginform" class="form-horizontal form-material" method="POST" action="{{ route('admin.login.submit') }}">
                {{ csrf_field() }}                            
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input id="email" type="email" placeholder="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="password" type="password" placeholder="kata sandi" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"  class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}> 

                                   <label class="custom-control-label" for="customCheck1">Ingat Saya</label>
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Lupa Password?</a> 
                        </div> 
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-block btn-lg btn-facebook btn-rounded" type="submit">Log In</button>
                    </div>
                </div>
                <!--                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                                    <div class="social">
                                                        <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                                        <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                                                    </div> 
                                                </div>
                                            </div>-->

            </form>
            <form class="form-horizontal" id="recoverform" action="index.html">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <h3>Recover Password</h3>
                        <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Email"> </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-facebook btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
