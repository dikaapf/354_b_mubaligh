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
                            <h5 class="card-title">SMS (sent)</h5>
                            <h6 class="card-subtitle">Daftar SMS Terkirim </h6>
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
                                    <th>Nomor Tujuan</th>
                                    <th>Pesan</th>
                                    <th>Tgl Kirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                @foreach($sms_keluar as $d)
                                <tr>
                                    <td><?= $no ?>. </td>
                                    <td><?= $d->DestinationNumber ?></td>
                                    <td><?= $d->TextDecoded ?></td>
                                    <td><?= $d->SendingDateTime ?></td>
                                    <th></th>

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