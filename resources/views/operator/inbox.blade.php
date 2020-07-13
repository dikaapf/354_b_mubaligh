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
                            <h5 class="card-title">SMS (inbox)</h5>
                            <h6 class="card-subtitle">Daftar SMS Masuk </h6>
                        </div>

                    </div>
                    <div class="col-md-12 align-self-center text-right">
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
                                    <th>Nomor Pengirim</th>
                                    <th>Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                @foreach($sms_masuk as $d)
                                <tr>
                                    <td><?= $no ?>. </td>
                                    <td><?= $d->SenderNumber ?></td>
                                    <td><?= $d->TextDecoded ?></td>
                                    <th>
                                        <a class="btn btn-dark btn-sm _kirimPesan"  data-no_hp="<?= $d->SenderNumber ?>"  href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Balas Pesan "><i class="fa fa-envelope"></i></a>

                                        <div class="modal fade bs-example-modal-lg" id="myLargeModalLabel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>Kirim Pesan Singkat (SMS)</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(['url' => 'pesan', 'class' => 'form-horizontal','id'=>'form_pesan']) !!}

                                                        <div class="form-group">
                                                            <label for="recipient-name" class="control-label">Nomor Tujuan:</label>
                                                            <input type="text" class="form-control" name="destinationnumber" readonly="" id="destNumber">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">Isi Pesan:</label>
                                                            <textarea class="form-control" name="textdecoded"></textarea>
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

                                    </th>

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
                url: "<?= url('/sms/balaspesan') ?>",
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
    })

</script>
@endsection