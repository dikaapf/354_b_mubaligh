@extends('layouts.tpl_admin')
@section('title')
Pengajar
@stop

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Data Pengajar</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('/') ?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Pengajar</li>
                </ol>
                <a href="{{ url('pengajar/create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Tambah Pengajar</a>
                <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>-->
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">Pengajar</h5>
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tblpengajar">
                            <thead>
                                <tr>
                                    <th>ID</th><th>Name</th><th>Email</th><th>Job Desc</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengajar as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('pengajar', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->email }}</td><td>{{ $item->job_desc }}</td>
                                    <td>
                                        <a href="{{ url('pengajar/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['pengajar', $item->id],
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
        $('#tblpengajar').DataTable({
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

