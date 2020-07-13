@extends('layouts.tpl_admin')
@section('title')
Jenislayanan
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
                            <h5 class="card-title">Jenis Layanan</h5>
                            <h6 class="card-subtitle">Daftar layanan pada sistem </h6>
                        </div>

                    </div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                         {{ session('status') }}

                    </div>
                    @endif
                    <div class="col-md-12 align-self-center text-right">
                        <a href="{{ url('jenislayanan/create') }}" class="btn btn-info btn-rounded btn-block"><i class="fa fa-plus"></i> &nbsp; Tambah Layanan</a>
                    </div>
                    <hr>
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tbljenislayanan">
                            <thead>
                                <tr>
                                    <th>ID</th><th>Nama Layanan</th><th>Deskripsi</th><th>Status</th><th width='15%'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jenislayanan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_layanan }}</td>
                                    <td><?= $item->deskripsi ?></td>
                                    <td><?= $item->status_layanan==1?'<span class="text-success card-title">Aktif</span>':'<span class="text-danger card-title">Non_Aktif</span>' ?></td>
                                    <td>

                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['jenislayanan', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        <a class="btn btn-info btn-sm " href="<?= url('jenislayanan') . '/' . Crypt::encrypt($item->id) . '/edit' ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        @if($item->status_layanan==0)
                                        <a class="btn btn-primary btn-sm" href="<?= url('layanan') . '/' . Crypt::encrypt($item->id) . '/aktif' ?>" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check-square"></i></a>
                                        @else
                                        <a class="btn btn-primary btn-sm" href="<?= url('layanan') . '/' . Crypt::encrypt($item->id) . '/nonaktif' ?>" data-toggle="tooltip" data-placement="top" title="Nonaktifkan"><i class="fa fa-times-rectangle"></i></a>
                                        @endif
                                        <button onclick="return confirm('AKAN MENGHAPUS LAYANAN?')" type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                        {!! Form::close() !!}
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
        $('#tbljenislayanan').DataTable({
            columnDefs: [{
                    targets: [0],
                    visible: false,
                    searchable: false
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
@endsection