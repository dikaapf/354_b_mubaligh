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
                            <h5 class="card-title">Tambah Operator</h5>
                            <h6 class="card-subtitle">Silahkan Isikan form pendaftaran operator baru dengan data yang sesuai </h6>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">Formulir Registrasi Operator</h4>
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                         {{ session('status') }}

                                    </div>
                                    @endif
                                    {!! Form::open(['url' => 'addoperator', 'class' => 'form-horizontal', 'files'=>'true','novalidate']) !!}

                                    <div class="form-body">
                                        <h3 class="box-title">Data Operator</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Username <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="email"  class="form-control" required data-validation-required-message="Wajib diisi" placeholder="Username"> 

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Nama Lengkap <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="nama"  class="form-control" required data-validation-required-message="Wajib diisi" placeholder="Nama lengkap"> 

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Nomor HP/Whatsapp <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text"  name="no_hp" maxlength="12" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="Isian Angka" placeholder="No WA dengan format 08xxxx"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Alamat <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="alamat" id="textarea" class="form-control" required placeholder="Isikan alamat yang aktif"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Unit Kerja <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="unit_kerja"  class="form-control" required data-validation-required-message="Wajib diisi" placeholder="Unit Kerja"> 

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Jabatan <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="job_title"  class="form-control" required data-validation-required-message="Wajib diisi" placeholder="Jabatan"> 

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Password <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="password" name="password" class="form-control" required minlength="6" placeholder="Password minimal 6 karakter" data-validation-required-message="Wajib isi "> </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Ulangi Password <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="password" name="password2" data-validation-match-match="password" class="form-control" required placeholder="Ulangi password"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-info">Daftar</button>
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
