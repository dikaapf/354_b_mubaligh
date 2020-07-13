@extends('layouts.tpl_operator')
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
                            <h5 class="card-title">Jenis Layanan Administrasi Kependudukan dan Pencatatan Sipil</h5>
                            <h6 class="card-subtitle">Silahkan pilih jenis layanan yang diinginkan </h6>
                        </div>
                        
                    </div>
                    <div class="row">
                        <!-- column -->
                       


                    </div>
                    <!-- Row -->
                </div>
            </div>
            <!-- End Row -->  

        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> DATA PENGGUNA</span>
                </div>
                
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a id="sample_editable_1_new" class="btn sbold green" href="<?= url('user/add') ?>"> Tambah Pengguna
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Login Email</th>
                            <th>Instansi</th>
                            <th>Unit Kerja date</th>
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
                            <td><?= $d->instansi ?></td>
                            <td><?= $d->unit_kerja ?></td>
                            <td>[ubah]</td>
                        </tr>
                        <?php $no++ ?>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
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