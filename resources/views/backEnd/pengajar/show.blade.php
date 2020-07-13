@extends('backLayout.app')
@section('title')
Pengajar
@stop

@section('content')

    <h1>Pengajar</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Name</th><th>Email</th><th>Job Desc</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $pengajar->id }}</td> <td> {{ $pengajar->name }} </td><td> {{ $pengajar->email }} </td><td> {{ $pengajar->job_desc }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection