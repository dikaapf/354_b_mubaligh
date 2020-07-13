@extends('layouts.tpl_admin')
@section('title')
Pengguna
@stop

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Administrator Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Beranda</a></li>
                    <li class="breadcrumb-item active">Pengguna</li>
                </ol>
                <!--<a href="{{ url('pengguna/create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New Pengguna</a>-->
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
                    <h5 class="card-title text-uppercase">Pengguna</h5>
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tblpengguna">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th width='30%'>Nama Pengguna</th>
                                    <th>Deskripsi</th>
                                    <th>Verify at</th>
                                    <th>Provider</th>
                                    <th width='20%'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengguna as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('pengguna', $item->id) }}">{{ $item->email }}</a></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email_verified_at }}</td> 
                                    <td>{{ $item->user_provider }}</td>
                                    <td>
                                        <a href="{{ url('pengguna/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['pengguna', $item->id],
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
        $('#tblpengguna').DataTable({
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