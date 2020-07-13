@extends('layouts.tpl_operator')
@section('title')
Daftar Pengajuan | | Layanan Online Adminduk Kabupaten Jayawijaya
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
                            <h5 class="card-title">Daftar Pengajuan</h5>
                            <h6 class="card-subtitle">Daftar pengajuan layanan yang dilakukan oleh user </h6>
                        </div>
                    </div>
                    <div class="pull-right right">
                        <span class="label label-primary">Pengajuan baru</span> 
                        <span class="label label-success">Pengajuan selesai</span> 
                        <span class="label label-info">Pengajuan diproses</span> 
                        <span class="label label-inverse">Pengajuan disetujui</span> 
                        <span class="label label-danger">Pengajuan dibatalkan</span> 
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
                                    <th>Jenis Layanan</th>
                                    <th>NIK Pemohon</th>
                                    <th>Nama Pemohon</th>
                                    <th>Proses Terakhir</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status Terakhir</th>
                                    <th width="15%">Aksi</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                @foreach($pengajuan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><?= $item->nama_layanan ?></td>
                                    <td><?= $item->email ?></td>
                                    <td><?= $item->name ?></td>
                                    <td><?= $item->proses_terakhir ?></td>
                                    <td><?= tgltime_angka($item->tanggal_pengajuan) ?></td>
                                    <td><?= setStatusPengajuan($item->status_pengajuan) ?>
                                        <br><span class="small">diproses oleh :<br><?= $item->process_by ?></span>
                                    </td>
                                    <td>
                                        <a data-toggle="tooltip" title="Detail" href="<?= url('daftar-pengajuan' . '/' . Crypt::encrypt($item->id) . '/' . 'detail') ?>" class="btn btn-facebook btn-xs"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail </a>
                                        <a data-toggle="tooltip" target="_blank" title="Print" href="<?= url('daftar-pengajuan' . '/' . Crypt::encrypt($item->id) . '/' . 'print') ?>" class="btn btn-googleplus btn-xs"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</a>

                                    </td>
                                </tr>
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
    $(document).ready(function () {
        $('#myTable').DataTable({
        });
    });
</script>
@endsection