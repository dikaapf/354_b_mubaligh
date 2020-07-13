@extends('layouts.tpl_admin')
@section('title')
Database Bantuan | Layanan Online Adminduk Kabupaten Jayawijaya
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
                            <h5 class="card-title">Database Bantuan</h5>
                            <h6 class="card-subtitle">Data pertanyaan dan jawaban terkait penggunaan aplikasi dan layanan</h6>
                        </div>

                    </div>
                    <div class="col-md-12 align-self-center text-right">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#responsive-modal3"  class="btn btn-info btn-rounded btn-block"><i class="fa fa-exclamation-triangle"></i> &nbsp; Tambah Pertanyaan</a>
                    </div>
                    <div id="responsive-modal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                {!! Form::open([
                                'url' => ['bantuan'],
                                'class' => 'form-horizontal']) !!}

                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Pertanyaan dan Jawaban</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group {{ $errors->has('pertanyaan') ? 'has-error' : ''}}">
                                        {!! Form::label('pertanyaan', 'Pertanyaan: ', ['class' => 'control-label']) !!}
                                        <div >
                                            {!! Form::text('pertanyaan', null, ['class' => 'form-control','required']) !!}
                                            {!! $errors->first('pertanyaan', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>


                                    <div class="form-group {{ $errors->has('jawaban') ? 'has-error' : ''}}">
                                        {!! Form::label('jawaban', 'Jawaban: ', ['class' => 'control-label']) !!}
                                        <div >
                                            <!--<textarea  name="area"></textarea>-->
                                            {!! Form::textarea('jawaban', null, ['class' => 'form-control','rows'=>'3','required','id'=>'mymce']) !!}
                                            {!! $errors->first('jawaban', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                        {!! Form::label('status', 'Status: ', ['class' => 'control-label']) !!}
                                        <div class="">
                                            {!! Form::select('status',['1'=>'Aktif'] ,null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-danger waves-effect waves-light">Update Status</button>
                                </div>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        @if (session('status'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h3 class="text-info"><i class="fa fa-exclamation-triangle"></i> Perhatian</h3>                        
                            {{ session('status') }}

                        </div>
                        @endif
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Status</th>
                                    <th width='15%'>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                @foreach($bantuan as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td><?= $item->pertanyaan ?></td><td><?= $item->jawaban ?></td><td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ url('bantuan/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                                        <!--                                        {!! Form::open([
                                                                                'method'=>'DELETE',
                                                                                'url' => ['bantuan', $item->id],
                                                                                'style' => 'display:inline'
                                                                                ]) !!}
                                                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                                                                {!! Form::close() !!}-->
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
        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            });
        }
    })

</script>
@endsection