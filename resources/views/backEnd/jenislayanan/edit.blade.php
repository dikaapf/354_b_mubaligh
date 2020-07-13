@extends('layouts.tpl_admin')
@section('title')
Edit Layanan | Layanan Online Adminduk Kabupaten Jayawijaya
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
                            <h5 class="card-title">Edit Layanan</h5>
                            <h6 class="card-subtitle">Isikan data layanan yang hendak diubah ke dalam sistem </h6>
                        </div>


                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-header">
                                    <!--<h4 class="m-b-0 text-info">Formulir Edit Jenis Layanan-->
                                    <div class="align-self-center text-right">
                                        <div class="d-flex justify-content-end align-items-center">

                                            <a href="<?= url('jenislayanan') ?>" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-external-link"></i>   Kembali</a>
                                        </div>
                                    </div>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                         {{ session('status') }}

                                    </div>
                                    @endif
                                    {!! Form::model($jenislayanan, [
                                    'method' => 'PATCH',
                                    'url' => ['jenislayanan', $jenislayanan->id],
                                    'class' => 'form-horizontal',
                                    'files'=>'true'
                                    ]) !!}
                                    <div class="form-body">
                                        <h3 class="box-title">Data Layanan</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{!! Form::label('nama_layanan', 'Nama Layanan: ', ['class' => 'control-label']) !!} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::hidden('id', null, ['class' => 'form-control', 'required','data-validation-required-message'=>'Wajib diisi','placeholder'=>'Isi nama layanan']) !!}
                                                        {!! Form::text('nama_layanan', null, ['class' => 'form-control', 'required','data-validation-required-message'=>'Wajib diisi','placeholder'=>'Isi nama layanan']) !!}
                                                        {!! $errors->first('nama_layanan', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>{!! Form::label('deskripsi', 'Deskripsi: ', ['class' => 'control-label']) !!}
                                                        <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        {!! Form::textarea('deskripsi', null, ['class' => 'form-control','required', 'placeholder'=>'Isi Deskripsi layanan','id'=>'mymce']) !!}
                                                    </div>
                                                </div>





                                            </div>
                                            <div class="col-md-6">
                                                <!--                                                <div class="form-group">
                                                                                                    <h5>File Petunjuk Penggunaan <span class="text-danger">*</span></h5>
                                                                                                    <div class="controls">
                                                                                                        {!! Form::text('link', $jenislayanan->link_dokumen, ['class' => 'form-control', 'readonly']) !!}
                                                                                                        <input type="file" name="link_dokumen" class="form-control"> 
                                                
                                                                                                    </div>
                                                                                                </div>-->
                                                <div class="form-group">
                                                    <h5>Gambar Layanan <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="<?= asset($jenislayanan->link_gambar) ?>" class="img-responsive radius" /></div>
                                                        </div>
                                                        <input type="file" name="link_gambar" class="form-control"> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>{!! Form::label('kirim_syarat', 'Fisik Dokumen Pengajuan: ', ['class' => 'control-label']) !!} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="checkbox" name="kirim_syarat" value="1"  <?= $jenislayanan->kirim_syarat == 1 ? 'checked' : '' ?> class="js-switch" data-color="#cd0a0a" data-size="small"/> Pemohon harus mengirimkan dokumen fisik persyaratan ke Disdukcapil sebelum pengajuan dapat diproses lebih lanjut<br>

                                                        {!! $errors->first('kirim_syarat', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>{!! Form::label('ambil_dok', 'Pengambilan Dokumen: ', ['class' => 'control-label']) !!} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="checkbox" name="ambil_dok" value="1" <?= $jenislayanan->ambil_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/> Dokumen Kependudukan dapat diambil sendiri<br>
                                                        <input type="checkbox" name="kirim_dok" value="1" <?= $jenislayanan->kirim_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/> Dokumen Kependudukan dapat dikirm melalui expedisi<br>
                                                        <input type="checkbox" name="info_dok" value="1" <?= $jenislayanan->info_dok == 1 ? 'checked' : '' ?>  class="js-switch" data-color="#cd0a0a" data-size="small"/> Hasil Layanan diinformasikan melalui pesan SMS/Whatsapp<br>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <h3 class="box-title">Persyaratan Layanan</h3>
                                        <h6 class="card-subtitle">Daftar persyaratan yang harus dipenuhi oleh pemohon sebelum melakukan pengajuan layanan </h6>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">					
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <?php
//                                                            print_r($persyaratan);
                                                            ?>
                                                            <table  class="table card-table table-vcenter">
                                                                <thead  class="bg-dark text-white">
                                                                    <tr>
                                                                        <th class="text-white">Persyaratan</th>
                                                                        <th class="text-white w-1 text-center" width='1%'></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($persyaratan as $dsya)
                                                                    <tr>
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" value="<?= $dsya->nama_persyaratan ?>" placeholder="Syarat layanan" name="nama_persyaratan_edit[]">
                                                                            <input type="hidden" class="form-control" value="<?= $dsya->id ?>" placeholder="Syarat layanan" name="persyaratan_id[]">

                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" data-tmodel='Persyaratan' data-id_t='<?= $dsya->id ?>' class="btn btn-sm block btn-danger row-remove _delRec" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <table id="idTabelSyarat" class="table card-table table-vcenter">
                                                                <tbody>

                                                                    <tr id='syarat0' data-id="0">
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" placeholder="Syarat layanan" name="nama_persyaratan[]">
                                                                        </td>							
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" class="btn btn-sm block btn-danger row-remove"  data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>															
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td width='1%'>
                                                                            <button type="button" id="idTambahSyarat" class="btn btn-block btn-sm btn-info mr-2"><i class="fe fe-plus-circle"></i> Tambah persyaratan</button>	

                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>										
                                                </div>

                                            </div>

                                        </div>
                                        <h3 class="box-title">Mekanisme Layanan</h3>
                                        <h6 class="card-subtitle">Mekanisme pengajuan yang harus dilalui oleh pemohon terkait layanan ini </h6>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">					
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table card-table table-vcenter">
                                                                <thead  class="bg-primary text-white">
                                                                    <tr>
                                                                        <th class="text-white">Mekanisme</th>
                                                                        <th class="text-white w-1 text-center" width='1%'></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($mekanisme as $d)
                                                                    <tr>
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" value="<?= $d->nama_mekanisme ?>" placeholder="Syarat layanan" name="nama_mekanisme_edit[]">
                                                                            <input type="hidden" class="form-control" value="<?= $d->id ?>" name="mekanisme_id[]">

                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" data-tmodel='Mekanisme' data-id_t='<?= $d->id ?>' class="btn btn-sm block btn-danger row-remove _delRec" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>

                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <table id="idTabelMekanisme" class="table card-table table-vcenter">
                                                                <tbody>

                                                                    <tr id='mekanisme0' data-id="0">
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" placeholder="Mekanisme pengajuan layanan" name="nama_mekanisme[]">
                                                                        </td>							
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" class="btn btn-sm block btn-danger row-remove" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>															
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td  width='1%'>
                                                                            <button type="button" id="idTambahMekanisme" class="btn btn-block btn-sm btn-warning mr-2"><i class="fe fe-plus-circle"></i> Tambah Mekanisme</button>	

                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>										
                                                </div>
                                            </div>

                                        </div>
                                        <h3 class="box-title">Formulir</h3>
                                        <h6 class="card-subtitle">
                                            Daftar formulir yang harus diisi oleh pemohon untuk kemudian dikirim bersama persyaratan lainnya ke Disdukcapil
                                        </h6>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">					
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table card-table table-vcenter">
                                                                <thead  class="bg-success text-white">
                                                                    <tr>
                                                                        <th class="text-white">Nama Formulir</th>
                                                                        <th class="text-white">Deskripsi</th>
                                                                        <th class="text-white">Upload File</th>
                                                                        <th class="text-white w-1 text-center"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach($formulir as $df)
                                                                    <tr>
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" value="<?= $df->nama_formulir ?>" placeholder="Nama formulir" name="nama_formulir_edit[]">
                                                                            <input type="hidden" class="form-control" value="<?= $df->id ?>" name="formulir_id[]">

                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('deskripsi_formulir_edit[]', $df->deskripsi_formulir, ['class' => 'form-control','placeholder'=>'Deskripsi formulir']) !!}
                                                                        </td>
                                                                        <td>

                                                                            <input type="file" name="link_file_edit[]" class="form-control"> 

                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" data-tmodel='Formulir' data-id_t='<?= $df->id ?>' class="btn btn-sm block btn-danger row-remove _delRec" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>

                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <table id="idTabelFormulir" class="table card-table table-vcenter">
                                                                <tbody>

                                                                    <tr id='formulir0' data-id="0">
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" placeholder="Nama formulir" name="nama_formulir[]">
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('deskripsi_formulir[]', null, ['class' => 'form-control','placeholder'=>'Deskripsi formulir']) !!}

                                                                        </td>		
                                                                        <td>
                                                                            <div class="custom-file">

                                                                                <input type="file" name="link_file[]" class="form-control"> 

                                                                            </div>
                                                                        </td>					
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" class="btn btn-sm block btn-danger row-remove" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>

                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>															
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>
                                                                            <button type="button" id="idTambahFormulir" class="btn btn-block btn-sm btn-success mr-2"><i class="fe fe-plus-circle"></i> Tambah Formulir</button>	

                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>										
                                                </div>
                                            </div>

                                        </div>

                                        <h3 class="box-title">Isian Pengajuan</h3>
                                        <h6 class="card-subtitle">Daftar isian pada form pengajuan yang harus diisi oleh pemohon </h6>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">					
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table  class="table card-table table-vcenter">
                                                                <thead  class="bg-danger text-white">
                                                                    <tr>
                                                                        <th class="text-white">Nama Isian</th>
                                                                        <th class="text-white">Deskripsi</th>
                                                                        <th class="text-white w-1 text-center"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
//                                                                    print_r($formisian);
                                                                    ?>
                                                                    @foreach($formisian as $dis)
                                                                    <tr>
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" value="<?= $dis->nama_formisian ?>" placeholder="Nama isian" name="nama_formisian_edit[]">
                                                                            <input type="hidden" class="form-control" value="<?= $dis->id ?>" name="formisian_id[]">

                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('ket_form_edit[]', $dis->ket_form, ['class' => 'form-control','placeholder'=>'Deskripsi isian']) !!}

                                                                        </td>	
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" data-tmodel='Formisian' data-id_t='<?= $dis->id ?>' class="btn btn-sm block btn-danger row-remove _delRec" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <table id="idTabelIsian" class="table card-table table-vcenter">
                                                                <tbody>
                                                                    <tr id='isian0' data-id="0">
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" placeholder="Nama isian" name="nama_formisian[]">
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('ket_form[]', null, ['class' => 'form-control','placeholder'=>'Deskripsi isian']) !!}
                                                                        </td>					
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" class="btn btn-sm block btn-danger row-remove" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>															
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>
                                                                            <button type="button" id="idTambahIsian" class="btn btn-block btn-sm btn-warning mr-2"><i class="fe fe-plus-circle"></i> Tambah Isian</button>	

                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>

                                                        </div>
                                                    </div>										
                                                </div>
                                            </div>

                                        </div>
                                        <h3 class="box-title">Daftar dokumen yang harus diupload oleh pemohon</h3>
                                        <h6 class="card-subtitle">Daftar dokumen yang harus diupload oleh pemohon </h6>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">					
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table card-table table-vcenter">
                                                                <thead  class="bg-warning text-white">
                                                                    <tr>
                                                                        <th class="text-white">Dokumen Untuk Diupload</th>
                                                                        <th class="text-white w-1 text-center" width='1%'></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($dokumenupload as $ddok)
                                                                    <tr>
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" value="<?= $ddok->nama_dokumen ?>" placeholder="Dokumen upload" name="nama_dokumen_edit[]">
                                                                            <input type="hidden" class="form-control" value="<?= $ddok->id ?>" name="dokumenupload_id[]">

                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" data-tmodel='Dokumenupload' data-id_t='<?= $ddok->id ?>' class="btn btn-sm block btn-danger row-remove _delRec" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>

                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <table id="idTabelDokumen" class="table card-table table-vcenter">
                                                                <tbody>

                                                                    <tr id='mekanisme0' data-id="0">
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" placeholder="Dokumen upload" name="nama_dokumen[]">
                                                                        </td>							
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" class="btn btn-sm block btn-danger row-remove" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>															
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>
                                                                            <button type="button" id="idTambahDokumen" class="btn btn-block btn-sm btn-info mr-2"><i class="fe fe-plus-circle"></i> Tambah Dokumen</button>	

                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>										
                                                </div>
                                            </div>

                                        </div>
                                        <h3 class="box-title">Proses Pengerjaan</h3>
                                        <h6 class="card-subtitle">Daftar proses yang menggambarkan tahapan pemrosesan pengajuan yang telah disetujui </h6>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">					
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table  class="table card-table table-vcenter">
                                                                <thead  class="bg-purple text-white">
                                                                    <tr>
                                                                        <th class="text-white">Nama Isian</th>
                                                                        <th class="text-white">Deskripsi</th>
                                                                        <th class="text-white w-1 text-center"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($soplayanan as $dsop)
                                                                    <tr>
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" value="<?= $dsop->nama_proses ?>" placeholder="Nama proses" name="nama_proses_edit[]">
                                                                            <input type="hidden" class="form-control" value="<?= $dsop->id ?>" name="soplayanan_id[]">

                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('deskripsi_proses_edit[]', $dsop->deskripsi_proses, ['class' => 'form-control','placeholder'=>'Deskripsi proses']) !!}
                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" data-tmodel='Proseslayanan' data-id_t='<?= $dsop->id ?>' class="btn btn-sm block btn-danger row-remove _delRec" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>

                                                                    </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                            <table id="idTabelProses" class="table card-table table-vcenter">
                                                                <tbody>
                                                                    <tr id='isian0' data-id="0">
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" placeholder="Nama proses" name="nama_proses[]">
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('deskripsi_proses[]', null, ['class' => 'form-control','placeholder'=>'Deskripsi proses']) !!}
                                                                        </td>					
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" class="btn btn-sm block btn-danger row-remove" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>															
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>
                                                                            <button type="button" id="idTambahProses" class="btn btn-sm btn-block btn-warning mr-2"><i class="fe fe-plus-circle"></i> Tambah Isian</button>	

                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>

                                                        </div>
                                                    </div>										
                                                </div>
                                            </div>

                                        </div>
                                        <h3 class="box-title">Dokumen Kependudukan Yang Dapat Didownload</h3>
                                        <h6 class="card-subtitle">Daftar dokumen kependudukan yang dapat didownlod oleh pemohon ketika pengajuan selesai diproses </h6>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">					
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table  class="table card-table table-vcenter">
                                                                <thead  class="bg-cyan text-white">
                                                                    <tr>
                                                                        <th class="text-white">Nama Dokumen</th>
                                                                        <th class="text-white">Deskripsi</th>
                                                                        <th class="text-white w-1 text-center"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($dokumenlayanan as $dlyn)
                                                                    <tr>
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" value="<?= $dlyn->nama_dok_download ?>" placeholder="Nama Dokumen" name="nama_dok_download_edit[]">
                                                                            <input type="hidden" class="form-control" value="<?= $dlyn->id ?>" name="dokumenlayanan_id[]">

                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('dokumen_deskripsi_edit[]', $dlyn->dokumen_deskripsi, ['class' => 'form-control','placeholder'=>'Deskripsi ']) !!}

                                                                        </td>	
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" data-tmodel='Dokumenlayanan' data-id_t='<?= $dlyn->id ?>' class="btn btn-sm block btn-danger row-remove _delRec" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>

                                                                    </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                            <table id="idTabelDownload" class="table card-table table-vcenter">
                                                                <tbody>
                                                                    <tr id='isian0' data-id="0">
                                                                        <td class="px-0">
                                                                            <input type="text" class="form-control" placeholder="Nama Dokumen" name="nama_dok_download[]">
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('dokumen_deskripsi[]', null, ['class' => 'form-control','placeholder'=>'Deskripsi ']) !!}
                                                                        </td>					
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" name="del0" class="btn btn-sm block btn-danger row-remove" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-times-rectangle"></i></button>
                                                                            </div>                                                             
                                                                        </td>
                                                                    </tr>															
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>
                                                                            <button type="button" id="idTambahDownload" class="btn btn-sm btn-block btn-warning mr-2"><i class="fe fe-plus-circle"></i> Tambah Isian</button>	

                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>										
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="reset"  class="btn btn-block btn-default"><i class="fa fa-plus-circle"></i> Reset</button>

                                    <button type="submit"  class="btn btn-block btn-info"><i class="fa fa-edit"></i> Update</button>
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
        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            });
        }
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
        $('._delRec').on('click', function (e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var id = $(this).data('id_t');
            var tmodel = $(this).data('tmodel');
            if (confirm('Hapus Data?')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                if (e.handled != true) {
                    $.ajax({
                        url: "<?= url('delete/') ?>/" + tmodel,
                        type: "POST",
                        async: false,
                        data: {
                            'id': id
                        },
                        success: function (data) {
                            if (data == 1) {
//                                alert('Ok')
//                            $("._submitActivateKK").prop('disabled', true);
                                location.reload();
                            }



                        },
                        error: function (jqXHR, textStatus, errorThrown) {
//                        alert(jqXHR.status);
//                        alert(textStatus);
                            if (errorThrown == 'Unauthorized') {
                                alert('Sesi login anda berakhir, \nSilahkan login kembali');

                            }
                        }
                    });

                }
            }



        });
        $("#idTambahSyarat").on("click", function () {
            var newid = 0;
            $.each($("#idTabelSyarat tr"), function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;
            var tr = $("<tr></tr>", {
                id: "syarat" + newid,
                "data-id": newid
            });
            $.each($("#idTabelSyarat tbody tr:nth(0) td"), function (index) {
                var td;
                var cur_td = $(this);
                var children = cur_td.children();
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.appendTo($(td));
                if (index == 0) {
                    td.addClass('px-0');
                }
                td.appendTo($(tr));
            });
            $(tr).appendTo($('#idTabelSyarat'));
            $(tr).find("td div button.row-remove").on("click", function () {
                $(this).closest("tr").remove();
            });
        });
        $("#idTambahMekanisme").on("click", function () {
            var newid = 0;
            $.each($("#idTabelMekanisme tr"), function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;
            var tr = $("<tr></tr>", {
                id: "mekanisme" + newid,
                "data-id": newid
            });
            $.each($("#idTabelMekanisme tbody tr:nth(0) td"), function (index) {
                var td;
                var cur_td = $(this);
                var children = cur_td.children();
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.appendTo($(td));
                if (index == 0) {
                    td.addClass('px-0');
                }
                td.appendTo($(tr));
            });
            $(tr).appendTo($('#idTabelMekanisme'));
            $(tr).find("td div button.row-remove").on("click", function () {
                $(this).closest("tr").remove();
            });
        });
        $("#idTambahFormulir").on("click", function () {
            var newid = 0;
            $.each($("#idTabelFormulir tr"), function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;
            var tr = $("<tr></tr>", {
                id: "formulir" + newid,
                "data-id": newid
            });
            $.each($("#idTabelFormulir tbody tr:nth(0) td"), function (index) {
                var td;
                var cur_td = $(this);
                var children = cur_td.children();
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.appendTo($(td));
                if (index == 0) {
                    td.addClass('px-0');
                }

                if (index == 2) {
                    $(td).find("input").val("");
                    $(td).find(".custom-file-label").html("Formulir berformat excel");
                }

                td.appendTo($(tr));
            });
            $(tr).appendTo($('#idTabelFormulir'));
            $(tr).find("td div button.row-remove").on("click", function () {
                $(tr).find("td div input.custom-file-input").val("");
                $(this).closest("tr").remove();
            });
            $(tr).find("td div input.custom-file-input").on("change", function (event) {
                $(this).next('.custom-file-label').html(event.target.files[0].name);
                if (event.target.files[0].size > (1024 * 500)) {
                    swal("Peringatan", "Pastikan ukuran file tidak melebihi 500 KB", "warning");
                    $(this).val('');
                    $(this).next('.custom-file-label').html('');
                }
            });
        });
        $("#idTabelFormulir").find("td div input.custom-file-input").on("change", function (event) {
            $(this).next('.custom-file-label').html(event.target.files[0].name);
            if (event.target.files[0].size > (1024 * 500)) {
                swal("Peringatan", "Pastikan ukuran file tidak melebihi 500 KB", "warning");
                $(this).val('');
                $(this).next('.custom-file-label').html('');
            }
        });
        $("#idTambahIsian").on("click", function () {
            var newid = 0;
            $.each($("#idTabelIsian tr"), function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;
            var tr = $("<tr></tr>", {
                id: "isian" + newid,
                "data-id": newid
            });
            $.each($("#idTabelIsian tbody tr:nth(0) td"), function (index) {
                var td;
                var cur_td = $(this);
                var children = cur_td.children();
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.appendTo($(td));
                if (index == 0) {
                    td.addClass('px-0');
                }
                td.appendTo($(tr));
            });
            $(tr).appendTo($('#idTabelIsian'));
            $(tr).find("td div button.row-remove").on("click", function () {
                $(this).closest("tr").remove();
            });
        });
        $("#idTambahDokumen").on("click", function () {
            var newid = 0;
            $.each($("#idTabelDokumen tr"), function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;
            var tr = $("<tr></tr>", {
                id: "dokumen" + newid,
                "data-id": newid
            });
            $.each($("#idTabelDokumen tbody tr:nth(0) td"), function (index) {
                var td;
                var cur_td = $(this);
                var children = cur_td.children();
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.appendTo($(td));
                if (index == 0) {
                    td.addClass('px-0');
                }
                td.appendTo($(tr));
            });
            $(tr).appendTo($('#idTabelDokumen'));
            $(tr).find("td div button.row-remove").on("click", function () {
                $(this).closest("tr").remove();
            });
        });
        $("#idTambahProses").on("click", function () {
            var newid = 0;
            $.each($("#idTabelProses tr"), function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;
            var tr = $("<tr></tr>", {
                id: "proses" + newid,
                "data-id": newid
            });
            $.each($("#idTabelProses tbody tr:nth(0) td"), function (index) {
                var td;
                var cur_td = $(this);
                var children = cur_td.children();
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.appendTo($(td));
                if (index == 0) {
                    td.addClass('px-0');
                }
                td.appendTo($(tr));
            });
            $(tr).appendTo($('#idTabelProses'));
            $(tr).find("td div button.row-remove").on("click", function () {
                $(this).closest("tr").remove();
            });
        });
        $("#idTambahDownload").on("click", function () {
            var newid = 0;
            $.each($("#idTabelDownload tr"), function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;
            var tr = $("<tr></tr>", {
                id: "download" + newid,
                "data-id": newid
            });
            $.each($("#idTabelDownload tbody tr:nth(0) td"), function (index) {
                var td;
                var cur_td = $(this);
                var children = cur_td.children();
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.appendTo($(td));
                if (index == 0) {
                    td.addClass('px-0');
                }
                td.appendTo($(tr));
            });
            $(tr).appendTo($('#idTabelDownload'));
            $(tr).find("td div button.row-remove").on("click", function () {
                $(this).closest("tr").remove();
            });
        });
    })

</script>
@endsection