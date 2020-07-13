@extends('layouts.tpl_admin')
@section('title')
Data Pengguna
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
                            <h5 class="card-title">Data Operator</h5>
                            <h6 class="card-subtitle">Operator yang memiliki akses </h6>
                        </div>

                    </div>
                    <div class="col-md-12 align-self-center text-right">
                        <a href="<?= route('operator.add') ?>" class="btn btn-info btn-rounded btn-block"><i class="fa fa-user-plus"></i> &nbsp; Tambah Operator</a>
                    </div>
                    <div class="table-responsive m-t-40">
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
                                    <td><?= $d->nama ?></td>
                                    <td><?= $d->email ?></td>
                                    <td><span class="badge <?= $d->status_operator == 1 ? 'badge-success' : 'badge-danger' ?>"><?= getStatus($d->status_operator) ?></span></td>
                                    <td>
                                        <a class="btn btn-info btn-sm " href="<?= url('operator') . '/' . Crypt::encrypt($d->id) . '/edit' ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        @if($d->status_operator==0)
                                        <a class="btn btn-primary btn-sm" href="<?= url('operator') . '/' . Crypt::encrypt($d->id) . '/verifikasi' ?>" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check-square"></i></a>
                                        @else
                                        <a class="btn btn-primary btn-sm" href="<?= url('operator') . '/' . Crypt::encrypt($d->id) . '/batalverifikasi' ?>" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fa fa-times-rectangle"></i></a>
                                        @endif

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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $(document).ready(function () {

        $('#myTable').DataTable();
    })

</script>
@endsection