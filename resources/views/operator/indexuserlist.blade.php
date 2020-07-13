@extends('layouts.tpl_operator')
@section('title')
Data Pengguna | Layanan Online Adminduk Kabupaten Jayawijaya
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
                            <h5 class="card-title">Data Pengguna</h5>
                            <h6 class="card-subtitle">Pengguna yang memiliki akses </h6>
                        </div>

                    </div>
                    <div class="col-md-12 align-self-center text-right">
                        <!--<a href="<?= route('operator.add') ?>" class="btn btn-info btn-rounded btn-block"><i class="fa fa-user-plus"></i> &nbsp; Tambah Pengguna</a>-->
                    </div>
                    <div class="table-responsive m-t-40">
                        @if (session('status'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                         {{ session('status') }}

                        </div>
                        @endif
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Login</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                @foreach($user_list as $d)
                                <tr>
                                    <td><?= $no ?>. </td>
                                    <td><?= $d->name ?></td>
                                    <td><?= $d->email ?></td>
                                    <td>
                                        <span class="badge <?= $d->status_user == 2 ? 'badge-warning' : '' ?> <?= $d->status_user == 0 ? 'badge-danger' : '' ?>  <?= $d->status_user == 1 ? 'badge-success' : '' ?>"><?= getVerifikasi($d->status_user) ?>                                         
                                        </span>
                                        @if($d->status_user==1)
                                        <a class="btn btn-facebook btn-sm _kirimSMS " data-nama_user="<?= $d->name ?>" data-no_hp="<?= $d->no_hp ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Kirim SMS Notifikasi Telah Diverifikasi"><i class="fa fa-envelope"></i></a>

                                        @endif
                                        @if($d->status_user==2)
                                        <a class="btn btn-dark btn-sm _kirimPesan"  data-user_id="<?= $d->id ?>" data-no_hp="<?= $d->no_hp ?>"  href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Kirim Pesan SMS Status PENDING"><i class="fa fa-envelope"></i></a>
                                        @endif

                                        <div class="modal fade bs-example-modal-lg" id="myLargeModalLabel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>Kirim Pesan Singkat (SMS)</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(['url' => 'pesan', 'class' => 'form-horizontal','id'=>'form_pesan']) !!}
                                                        <input type="hidden" class="form-control" readonly="" name="user_id" id="user_id">

                                                        <div class="form-group">
                                                            <label for="recipient-name" class="control-label">Nomor Tujuan:</label>
                                                            <input type="text" class="form-control" name="destinationnumber" readonly="" id="destNumber">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">Isi Pesan:</label>
                                                            <select class="selectpicker" name="smsoption" data-style="form-control btn-secondary">
                                                                <option value="1">Proses verifikasi di pending</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">Pilih Alasan:</label>
                                                            <div
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="alasan[]" value="NIK yang tidak sesuai" id="aax">
                                                                    <label class="custom-control-label" for="aax">NIK yang tidak sesuai</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="alasan[]" value="Nomor KK  tidak sesuai" id="bbx">
                                                                    <label class="custom-control-label" for="bbx">Nomor KK  tidak sesuai</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="alasan[]" value="Nama Lengkap  tidak sesuai" id="ccx">
                                                                    <label class="custom-control-label" for="ccx">Nama Lengkap  tidak sesuai</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="alasan[]" value="Pendaftar bukan Kepala Keluarga" id="customCheck1">
                                                                    <label class="custom-control-label" for="customCheck1">Pendaftar bukan Kepala Keluarga</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="alasan[]" value="Foto KTP tidak sesuai" id="customCheck2">
                                                                    <label class="custom-control-label" for="customCheck2">Foto KTP tidak sesuai</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="alasan[]" value="Foto KK tidak sesuai" id="customCheck3">
                                                                    <label class="custom-control-label" for="customCheck3">Foto KK tidak sesuai</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="alasan[]" value="Foto Tandatangan tidak sesuai" id="customCheck5">
                                                                    <label class="custom-control-label" for="customCheck5">Foto Tandatangan tidak sesuai</label> 
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="alasan[]" value="Foto Selfie tidak sesuai" id="customCheck6">
                                                                    <label class="custom-control-label" for="customCheck6">Foto Selfie tidak sesuai</label> 
                                                                </div>


                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Solusi:</label>

                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="solusi[]" value="Silahkan lakukan upload ulang dokumen" id="customCheck4">
                                                                    <label class="custom-control-label" for="customCheck4">Silahkan lakukan upload ulang dokumen </label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="solusi[]" value="Silahkan Kepala Keluarga melakukan registrasi" id="customCheck7">
                                                                    <label class="custom-control-label" for="customCheck7">Silahkan Kepala Keluarga melakukan registrasi </label>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-facebook btn-sm">Kirm Pesan</button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                    </td>
                                    <td>
                                        <a class="btn btn-facebook btn-sm" href="<?= url('pengguna') . '/' . Crypt::encrypt($d->id) . '/detail' ?>" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>

                                        <a class="btn btn-info btn-sm" href="<?= url('pengguna') . '/' . Crypt::encrypt($d->id) . '/edit' ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-success btn-sm" target="_blank" href="https://web.whatsapp.com/send?phone=<?= $d->no_hp ?>" data-toggle="tooltip" data-placement="top" title="Kirim Whatsapp"><i class="fa fa-whatsapp"></i></a>
                                        @if($d->status_user==0)
                                        <a class="btn btn-primary btn-sm" href="<?= url('pengguna') . '/' . Crypt::encrypt($d->id) . '/verifikasi' ?>" data-toggle="tooltip" data-placement="top" title="Verifikasi"><i class="fa fa-check-square"></i></a>
                                        <a class="btn btn-facebook btn-sm" href="<?= url('pengguna') . '/' . Crypt::encrypt($d->id) . '/pending' ?>"  data-toggle="tooltip" data-placement="top" title="Pending"><i class="fa fa-exclamation-triangle"></i></a>
                                        @else
                                        <a class="btn btn-primary btn-sm" href="<?= url('pengguna') . '/' . Crypt::encrypt($d->id) . '/batalverifikasi' ?>" data-toggle="tooltip" data-placement="top" title="Batalkan Verifikasi"><i class="fa fa-times-rectangle"></i></a>
                                        @endif
                                        <a class="btn btn-googleplus btn-sm" href="<?= url('pengguna') . '/' . Crypt::encrypt($d->id) . '/hapus' ?>" onclick="return confirm('menghapus user?')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>

                                    </td> 
                                </tr>
                                <?php $no++ ?>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- Row -->
                </div>
            </div>
            <!-- End Row -->  

        </div>
    </div>

</div>

@endsection
@section('scripts')
{!! Form::open(['url' => '#',]) !!}
{!! Form::close() !!}

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $(document).ready(function () {

        $('#myTable').DataTable();
        $('._kirimPesan').click(function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();

            if (e.handled !== true) {
                var no_hp = ($(this).data('no_hp'));
                var user_id = ($(this).data('user_id'));
                $('#myLargeModalLabel').modal().show();
                $('#destNumber').val(no_hp);
                $('#user_id').val(user_id);
            }

        });

        $('form#form_pesan').on('submit', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?= url('/sms/kirimpesan') ?>",
                type: "POST",
                async: false,
                data: $("#form_pesan").serialize(),
                success: function (data) {
//                    $('#data_bawahan').html(data);
                    if (data == 1) {
                        swal({
                            title: "Sip!.... OK,",
                            text: "Pesan terkirim",
                            type: "success",
                            allowOutsideClick: true,
                            confirmButtonClass: "btn_success",
                        });
                        $('#myLargeModalLabel').modal('hide');
                        location.reload();
                    } else {
                        swal({
                            title: "opps!!!,",
                            text: "Pesan gagal",
                            type: "error",
                            allowOutsideClick: true,
                            confirmButtonClass: "btn_danger",
                        });
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
//                        alert(jqXHR.status);
//                        alert(textStatus);
                    if (errorThrown == 'Unauthorized') {
                        alert('Sesi login anda berakhir, \nSilahkan login kembali');
                        location.reload();

                    }
                }
            });


        });

        $('._kirimSMS').click(function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();

            if (e.handled !== true) {
                var no_hp = ($(this).data('no_hp'));
                var nama = ($(this).data('nama_user'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                $.ajax({
                    url: "<?= url('sms/verifikasi') ?>",
                    type: "POST",
                    async: false,
                    data: {
                        'no_hp': no_hp,
                        'nama': nama,
                    },
                    dataType: 'json',
                    success: function (re) {

//                            alert(re);
                        $('#error_result').html(re);

//                            alert(re); 
//                            return;
                        e.preventDefault();
                        if (re == 1) {
//                              
                            alert('OK');
                        }

                    },
                    error: function (re) {
//                            alert('Ada Kesalahan'+ re.responseText);
                        $('#error_result').html('Status Proses \n' + re.responseText);

                    }
                });


            }

        });
    })

</script>
@endsection