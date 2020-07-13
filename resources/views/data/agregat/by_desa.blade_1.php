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
                    <h2>Data Agregat Penduduk <small>Tingkat Desa/Kelurahan/Kampung</small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
//                    print_r(setDataInstansi());
                    ?>
                    <br />
                    <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('agg.post_by_desa') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih DKB</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('t_dkb',listDKB(),null,['required'=>'','id'=>'t_dkb','class'=>'form-control']) !!}


                            </div>
                        </div>
                        <div class="">
                            <label>
                                <input type="checkbox" name="atribut[]" value="pddk_akh" class="js-switch" /> Pendidikan
                            </label>
                            <label>
                                <input type="checkbox" name="atribut[]" value="agama" class="js-switch" /> Agama
                            </label>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <!--<button class="btn btn-primary" type="reset">Reset</button>-->
                                <button type="submit" class="btn btn-warning">Tampilkan</button>
                                <!--<button class="btn btn-primary  _cetakDkb" type="button">Tampil</button>-->
                                <button class="btn btn-success  _cetakXls" type="button">Download excel</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(count($agregat)!=0)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <br />
                    <div style="text-align: center">
                        <h4><?= setDataInstansi()->instansi ?></h4> 
                        <h5><?= setDataInstansi()->opd ?></h5> 
                        <h5><?= setDataInstansi()->alamat ?></h5> 
                        <h5>JUMLAH PENDUDUK <?= strtoupper(setDataInstansi()->nama_kab) ?></h5>
                        <h5>TINGKAT KELURAHAN/KAMPUNG</h5>
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
                                    <th class="column-title">Jumlah Penduduk</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                $jum = 0;
                                ?>
                                @foreach($agregat as $t)
                                <tr class="odd pointer">
                                    <td class="a-center ">
                                        <?= $no . '. ' ?>
                                    </td>
                                    <td class=" "><?= $t->kdkec ?></td>
                                    <td class=" "><?= $t->nama_kec ?></td>
                                    <td class=" "><?= $t->kdkel ?></td>
                                    <td class=" "><?= $t->namadesa_kel ?></td>
                                    <td style="text-align: right"><?= number_format($t->jumlah_penduduk, 0, ',', '.') ?></td>

                                </tr>
                                <?php
                                $jum = $jum + $t->jumlah_penduduk;
                                $no++
                                ?>
                                @endforeach
                                <tr class="odd pointer">
                                    <th style="text-align: center" colspan="5">
                                        JUMLAH PENDUDUK
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
        $('body').delegate('._cetakDkb', 'click', function () {

//            alert($('#t_dkb').val());
            window.open("<?= url('agregat/by_desa/') ?>/" + $('#t_dkb').val() + "?download=pdf", "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=50,left=100,width=800,height=1000");


        });
        $('body').delegate('._cetakXls', 'click', function () {

//            alert($('#t_dkb').val());
            window.open("<?= url('agregat/by_desa/') ?>/" + $('#t_dkb').val() + "/xls", "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=50,left=100,width=400,height=600");


        });
    });
</script>
@endsection
