@extends('layouts.l_app')
@section('title')
Agregat Tingkat Desa
@stop
@section('content')
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Jumlah Cakupan Akta Kelahiran<small>Berdasarkan Data Konsolidasi Bersih</small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
//                    print_r(setDataInstansi());
                    ?>
                    <br />
                    <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('capil.lahir_periodik') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih DKB</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('t_dkb',listDKB(),null,['required'=>'','id'=>'t_dkb','class'=>'form-control']) !!}


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Propinsi</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('no_prop',listPropinsi(),null,['required'=>'','id'=>'no_prop','class'=>'form-control']) !!}


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten/Kota</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('no_kab',listKabupaten(),null,['required'=>'','id'=>'no_kab','class'=>'form-control']) !!}


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('no_kec',['semua'=>'Semua'],null,['required'=>'','id'=>'no_kec','class'=>'form-control']) !!}


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelurahan/Kampung</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('no_kel',['semua'=>'Semua'],null,['required'=>'','id'=>'no_kel','class'=>'form-control']) !!}


                            </div>
                        </div>
                        <!--                        <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jangka Waktu</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <div class="input-prepend input-group">
                                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                                    <input type="text"  name="reservation" id="reservation" class="form-control"  />
                                                                </div>
                                                            </div>
                                                        </div>
                        
                                                    </div>
                                                </div>-->


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <!--<button class="btn btn-primary" type="reset">Reset</button>-->
                                <button type="submit" class="btn btn-warning">Tampilkan</button>
                                <!--<button class="btn btn-primary  _cetakDkbJk" type="button">Tampil</button>-->
                                <!--<button class="btn btn-success  _cetakXlsAkta" type="button">Download excel</button>-->
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(count($capil_lahir)!=0)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <a href="<?= url('/files/jumlah_kepemilikan_akta_lahir.xlsx') ?>" class="btn btn-primary">Klik Untuk Download dalam format Excel</a>
                    <br />
                    <div style="text-align: center">
                        <h4><?= setDataInstansi()->instansi ?></h4> 
                        <h5><?= setDataInstansi()->opd ?></h5> 
                        <h5><?= setDataInstansi()->alamat ?></h5> 
                        <h5>JUMLAH KEPEMILIKAN AKTA KELAHIRAN <?= strtoupper(setDataInstansi()->nama_kab) ?></h5>
                        @if($nama_kec==null && $nama_kel==null)
                        <h5>TINGKAT KELURAHAN/KAMPUNG</h5>
                        @elseif($nama_kec!=null && $nama_kel==null)
                        KECAMATAN <?= $nama_kec ?>

                        @else
                        KECAMATAN <?= $nama_kec ?><br>
                        KELURAHAN/KAMPUNG/DESA  <?= $nama_kel ?>
                        @endif
                        <h5>TAHUN <?= strtoupper($tahun) ?></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th>
                                        #
                                    </th>
                                    <th class="column-title">Kode Kec </th>
                                    <th class="column-title">Nama Kec </th>
                                    <th class="column-title">Kode Kel/Kamp </th>
                                    <th class="column-title">Nama Kampung </th>
                                    <th class="column-title">L </th>
                                    <th class="column-title">P </th>
                                    <th class="column-title">Jumlah</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                $jum = 0;
                                ?>
                                @foreach($capil_lahir as $t)
                                <tr class="odd pointer">
                                    <td class="a-center ">
                                        <?= $no . '. ' ?>
                                    </td>
                                    <td class=" "><?= $t->kdkec ?></td>
                                    <td class=" "><?= $t->nama_kec ?></td>
                                    <td class=" "><?= $t->kdkel ?></td>
                                    <td class=" "><?= $t->namadesa_kel ?></td>
                                    <td class=" "><?= $t->lk ?></td>
                                    <td class=" "><?= $t->pr ?></td>
                                    <td style="text-align: right"><?= number_format($t->jumlah_penduduk, 0, ',', '.') ?></td>

                                </tr>
                                <?php
                                $jum = $jum + $t->jumlah_penduduk;
                                $no++
                                ?>
                                @endforeach
                                <tr class="odd pointer">
                                    <th style="text-align: center" colspan="7">
                                        JUMLAH KEPEMILIKAN AKTA KELAHIRAN
                                    </th>

                                    <th style="text-align: right"><?= number_format($jum, 0, ',', '.') ?></th>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('body').delegate('._cetakDkbJk', 'click', function () {

//            alert($('#t_dkb').val());
            window.open("<?= url('agregat/by_desa_jk/') ?>/" + $('#t_dkb').val() + "?download=pdf", "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=50,left=100,width=800,height=1000");


        });
        $('body').delegate('._cetakXlsAkta', 'click', function () {

//            alert($('#t_dkb').val());
            window.open("<?= url('capil/akta_lahir/') ?>/" + $('#t_dkb').val() + "/xls", "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=50,left=100,width=800,height=1000");


        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        ambilDistrik();
        ComboDistrik();
    });


    function ComboDistrik() {
        $('#no_kec').change(function () {
            var no_prop = $('#no_prop option:selected').val();
            var no_kab = $('#no_kab option:selected').val();
            var no_kec = $('#no_kec option:selected').val();
            ambilKampung(no_prop, no_kab, no_kec);
        });
    }

    function ambilDistrik() {
        var no_prop = $('#no_prop option:selected').val();
        var no_kab = $('#no_kab option:selected').val();
        $.ajax({
            url: "<?= url('optiondistrik') ?>",
            type: "POST",
            async: false,
            data: {
                'no_prop': no_prop,
                'no_kab': no_kab
            },
            success: function (re) {

                $('#no_kec').html(re);
                $('#no_kec option:selected').val();
                var no_prop = $('#no_prop option:selected').val();
                var no_kab = $('#no_kab option:selected').val();
                var no_kec = $('#no_kec option:selected').val();
                ambilKampung(no_prop, no_kab, no_kec);
                $("#wait").css("display", "none");
            },
            error: function (re) {
                alert('fail');
//                $('#konsentrasix').html('<option >Pilih</option>');
//                $('#semesterx').html('<option >Pilih</option>');

            }
        });
    }
    function ambilKampung(no_prop, no_kab, no_kec) {

        $.ajax({
            url: "<?= url('optionkampung') ?>",
            type: "POST",
            async: false,
            data: {
                'no_prop': no_prop,
                'no_kab': no_kab,
                'no_kec': no_kec
            },
            success: function (re) {
                $('#no_kel').html(re);
                $('#no_kel option:selected').val();
            },
            error: function (re) {
            }
        });
    }
</script>
@endsection
