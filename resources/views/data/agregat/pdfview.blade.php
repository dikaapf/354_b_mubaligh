


<style>
    .page-break {
        page-break-after: always;
    }
    body{
        font-family: arial; font-size: 8pt;
    }
</style>
<!--<h1>Page 1</h1>
<div class="page-break"></div>-->
<div class="container">
    @if(count($items['agregat'])!=0)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <br />
                    <div style="text-align: center">
                        <h4><?= setDataInstansi()->instansi ?><br>
                            <?= setDataInstansi()->opd ?><br>
                            <?= setDataInstansi()->alamat ?><br><br><br><br>
                            JUMLAH PENDUDUK <?= strtoupper(setDataInstansi()->nama_kab) ?><br>
                            TINGKAT KELURAHAN/KAMPUNG<br>
                            <?= strtoupper($items['tahun']) ?></h4>
                    </div>
                    <div class="table-responsive">
                        <table border='0.5' width='100%' class="table table-striped jambo_table bulk_action" style="border-collapse: collapse;">
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
                                @foreach($items['agregat'] as $t)
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

    <table>

        <tr>
            <td style="text-align: center">
                Tanda tangan pejabat penilai
                <br><br><br><br>


            </td>
            <td style="text-align: center">


            </td>
        </tr>
    </table>  



</div>
