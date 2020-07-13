@extends('layouts.l_app')
@section('title')
Rekapitulasi Pelayanan Akta Kelahiran
@stop
@section('content')
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Rekapitulasi Pelayanan Catatan Sipil<small>Data Pelayanan SIAK</small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
//                    print_r(setDataInstansi());
//                    listTahunCapilLahir();
                    ?>
                    <br />

                    <form data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('capil.rekap_lahir') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('tahun',listTahunCapilLahir(),null,['required'=>'','id'=>'tahun','class'=>'form-control']) !!}


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pencatatan</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('tabel_capil',listCapil(),null,['required'=>'','id'=>'tabel_capil','class'=>'form-control']) !!}


                            </div>
                        </div>




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
    @if(count($rekap_lahir)!=0)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <a href="<?= url('/files/rekap_pelayanan_akta_kelahiran.xlsx') ?>" class="btn btn-primary">Klik Untuk Download dalam format Excel</a>
                    <br />
                    <div style="text-align: center">
                        <h4><?= setDataInstansi()->instansi ?></h4> 
                        <h5><?= setDataInstansi()->opd ?></h5> 
                        <h5><?= setDataInstansi()->alamat ?></h5> 
                        <h5>REKAP PEMBUATAN AKTA  <?= strtoupper($kop . " " . setDataInstansi()->nama_kab) ?></h5>

                        <h5>TAHUN <?= strtoupper($tahun) ?></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>JANUARI</th>
                                    <th>FEBRUARI </th>
                                    <th>MARET </th>
                                    <th>APRIL </th>
                                    <th>MEI </th>
                                    <th>JUNI </th>
                                    <th>JULI </th>
                                    <th>AGUSTUS </th>
                                    <th>SEPTEMBER </th>
                                    <th>OKTOBER </th>
                                    <th>NOPEMBER </th>
                                    <th>DESEMBER </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
//                                        print_r($perekaman);
                                $toctk = 0;
                                ?>
                                @if(!empty($rekap_lahir))
                                @foreach($rekap_lahir as $d)
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $d->januari ?></td>
                                    <td><?= $d->februari ?></td>
                                    <td><?= $d->maret ?></td>
                                    <td><?= $d->april ?></td>
                                    <td><?= $d->mei ?></td>
                                    <td><?= $d->juni ?></td>
                                    <td><?= $d->juli ?></td>
                                    <td><?= $d->agustus ?></td>
                                    <td><?= $d->september ?></td>
                                    <td><?= $d->oktober ?></td>
                                    <td><?= $d->nopember ?></td>
                                    <td><?= $d->desember ?></td>
                                </tr>
                                <?php
                                $no++;
                                $toctk = $d->januari +
                                        $d->februari +
                                        $d->maret +
                                        $d->april +
                                        $d->mei +
                                        $d->juni +
                                        $d->juli +
                                        $d->agustus +
                                        $d->september +
                                        $d->oktober +
                                        $d->nopember +
                                        $d->oktober;
                                ?>
                                @endforeach
                                @endif
                            </tbody>


                        </table>
                        <p>Total Jumlah Pembuatan Akta <?= $kop ?> Tahun <?= strtoupper($tahun) ?> <?= " : " . number_format($toctk, 0, ',', '.') ?>  </p>

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


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

    });



</script>
@endsection
