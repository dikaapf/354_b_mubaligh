@extends('layouts.c_app')
@section('title')
Agregat Tingkat Desa
@stop
@section('content')
<div class="right_col" role="main">

   
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
                                    <th class="column-title">Jumlah </th>

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
