@extends('layouts.tpl_login')
@section('title')
Registrasi Penduduk | Layanan Online Adminduk Kabupaten Jayawijaya
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
                            <h5 class="card-title">Registrasi User Baru</h5>
                            <h6 class="card-subtitle">Silahkan Isikan form pendaftaran user baru dengan data yang sesuai </h6>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">Formulir Registrasi User</h4>
                                </div>
                                <div class="card-body">

                                    {!! Form::open(['url' => 'register', 'class' => 'form-horizontal', 'files'=>'true','novalidate']) !!}

                                    <div class="form-body">
                                        <h3 class="box-title">Informasi Pengguna</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text"  name="email" maxlength="16" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="Isian Angka" placeholder="NIK sesuai KTP"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Nama Lengkap <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name"  class="form-control" required data-validation-required-message="Wajib diisi" placeholder="Nama lengkap sesuai KTP"> 

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Nomor HP/Whatsapp <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text"  name="no_hp" maxlength="12" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="Isian Angka" placeholder="No WA dengan format 08xxxx"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Alamat pengiriman dokumen <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="alamat" id="textarea" class="form-control" required placeholder="Isikan alamat yang aktif"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text"  name="no_kk" maxlength="16" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="Isian Angka" placeholder="No KK"> </div>
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
                                    <h3 class="box-title">Dokumen Pendukung</h3>
                                    <hr class="m-t-0 m-b-40">
                                    <!-- Column -->
                                    <div class="alert alert-success">
                                        <span class="text-dark">Bagi Kepala Keluarga yang belum memiliki KTP-el (belum perekaman) dapat mengganti Foto KTP dengan mengupload foto akta kelahiran atau ijazah terakhir</span>

                                    </div>
                                    <div class="form-group">
                                        <h5>FOTO KTP / Akta Kelahiran / Ijazah terakhir<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="link_ktp" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>FOTO KARTU KELUARGA <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="link_kk" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>FOTO TANDA TANGAN<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="link_ttd" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>FOTO SELFIE MEMEGANG KTP<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="link_selfie" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Alamat email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="alamat_email" class="form-control" placeholder="Alamat Email" > </div>
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
