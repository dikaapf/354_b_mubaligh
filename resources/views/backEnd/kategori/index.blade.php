@extends('layouts.tpl_admin')
@section('title')
Kategori
@stop

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Data Kategori</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('/') ?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Kategori</li>
                </ol>
                <a href="{{ url('kategori/create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New Kategori</a>
                <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>-->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box -->
    <!-- ============================================================== -->
    <!-- .row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">Kategori</h5>
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tblkategori">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th width='30%'>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Flag Status</th>
                                    <th width='20%'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategori as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('kategori', $item->id) }}">{{ $item->nama_kategori }}</a></td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ $item->flag_status }}</td>
                                    <td>
                                        <a href="{{ url('kategori/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['kategori', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        $('#tblkategori').DataTable({
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