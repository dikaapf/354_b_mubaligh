@extends('backLayout.app')
@section('title')
Jenislayanan
@stop

@section('content')

    <h1>Jenislayanan</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Nama Layanan</th><th>Deskripsi</th><th>Link Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $jenislayanan->id }}</td> <td> {{ $jenislayanan->nama_layanan }} </td><td> {{ $jenislayanan->deskripsi }} </td><td> {{ $jenislayanan->link_dokumen }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection