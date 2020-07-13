<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Cetak Detail Pengajuan</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .page-break {
                page-break-after: always;
            }
            body{
                font-family: sans-serif; font-size: 10pt;
            }
            .s_container {
                display: flex; /*flex*/
            }
            .ssm_opcion {
                /*background: grey;*/
            }
            .ssm_opcion img {
                width: 600px;
                height: 100%;
            }
            #text_opcion {
                background: green;
                flex: 1 0 50px; /*grow + no shrink + basis*/
                display: flex; /*flex*/
                justify-content: flex-end; /*horizontal right*/
                align-items: flex-end; /*vertical bottom*/
            }
        </style>
    </head>
    <!--<h1>Page 1</h1>
<div class="page-break"></div>-->
    <body >
        <div class="container">
            <!-- Bootstrap -->
            <link rel="stylesheet" href="<?= asset('/') ?>/css/pdf.css">
            <div style="text-align: center; ">
                <h2>PEMERINTAH KABUPATEN JAYAWIJAYA<br>
                    DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h2>
                <h3><u>TRANSAKSI PENGAJUAN LAYANAN ADMINDUK</u><br>Nomor : <?= $items['pengajuan']->nomor_pengajuan ?></h3>
            </div>
            <table width='100%' border='1'  style="border-collapse: collapse">
                <tr  style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold; text-align: center; font-weight: bolder">JENIS LAYANAN YANG DIAJUKAN</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <h3><?= strtoupper($items['pelayanan']->nama_layanan) ?></h3>
                        <p><?= ($items['pelayanan']->deskripsi) ?></p>
                    </td>
                </tr>
                <tr  style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold">I. INFORMASI PEMOHON</td>
                </tr>
                <tr>
                    <td width='30%' style="padding: 5px 5px 5px 5px; border: #000 solid 1px; text-align: center">QR Code</td>
                    <td width='70%'  style="padding: 5px 5px 5px 5px; border: #000 solid 1px;text-align: center">Pemohon</td>

                </tr>
                <tr valign="top">
                    <td style="border: #000 solid 1px; text-align: center">
                        <b>Tanggal Pengajuan</b><br>
                        <?= $items['pengajuan']->tanggal_pengajuan ?><br>
                        <?php
                        $image = QrCode::format('png')
                                ->merge(public_path('img\logo_jyw.png'), 0.2, true)
                                ->size(1024)->errorCorrection('H')
                                ->generate($items['pengajuan']->nomor_pengajuan);
                        ?>
                        <img width="200" src="data:image/png;base64, {!! base64_encode($image) !!} ">

                    </td>
                    <td  style="padding: 10px 10px 10px 10px; border: #000 solid 1px; ">
                        <table width='100%'>
                            <tr>
                                <td style="padding: 3px 3px 3px 3px; ">NIK</td><td>:</td><td><?= $items['pengajuan']->email ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 3px 3px 3px; " >Nama Pemohon</td><td>:</td><td><?= $items['pengajuan']->name ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 3px 3px 3px; ">No. KK</td><td>:</td><td><?= $items['pengajuan']->no_kk ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 3px 3px 3px; ">No. HP/Whatsapp</td><td>:</td><td><?= $items['pengajuan']->no_hp ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 3px 3px 3px 3px; ">Alamat</td><td>:</td><td><?= $items['pengajuan']->alamat ?></td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold">II. RINCIAN PENGAJUAN</td>
                </tr>
                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold; text-align: center">Isian Pengajuan</td>
                </tr>
                <tr valign="top">
                    <td colspan="2" style="padding: 10px 10px 10px 10px; border: #000 solid 1px; ">
                        <table width='100%'>
                            <thead>
                                <tr style="background-color: lightgray;">
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Nama Isian</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Nilai</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Verifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dt = json_decode($items['pengajuan']->data_isian);
                                $dtup = json_decode($items['pengajuan']->data_upload);
//                            print_r($dt);
                                ?>
                                @foreach($dt as $keys)
                                @foreach($keys as $key => $value)
                                <tr >
                                    <td style="padding: 5px 5px 5px 5px;"><?= $key ?></td>
                                    <td style="padding: 5px 5px 5px 5px;">
                                        <?= $value ?>
                                    </td>
                                    <td width="5%" style="text-align: center;padding: 5px 5px 5px 5px;">
                                        <input type="checkbox">
                                    </td>

                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>

                    </td>
                </tr>
                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold; text-align: center">Dokumen Diupload</td>
                </tr>
                @foreach($dtup as $keys)
                <?php $n = 1 ?>
                @foreach($keys as $key => $value)
                <tr >
                    <td colspan="2" style="text-align: center;padding: 10px 10px 10px 10px;">
                        <b><?= $n . '. ' . $key ?></b>

                        <div class="s_container seleccion_simple_default">
                            <div class="ssm_opcion">
                                <img  src="<?= asset($value) ?>" class="img-responsive" alt="img" />
                            </div>
                        </div>
                    </td>

                </tr>
                <?php $n++ ?>
                @endforeach
                @endforeach
                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold">III. PROSES PENGERJAAN</td>
                </tr>

                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold; text-align: center">Penerimaan Kiriman Berkas Fisik Pengajuan</td>
                </tr>
                <tr vallign="top">
                    <td colspan="2" style="padding: 10px 10px 10px 10px;">
                        @if($items['pelayanan']->kirim_syarat==1)
                        <table width="100%">
                            <tr>
                                <td style="padding: 5px 5px 5px 5px;">Berkas diterima pada</td>
                                <td style="padding: 5px 5px 5px 5px;">:</td>
                                <td style="padding: 5px 5px 5px 5px;">.....................</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px 5px 5px 5px;">Berkas diterima oleh</td>
                                <td style="padding: 5px 5px 5px 5px;">:</td>
                                <td style="padding: 5px 5px 5px 5px;">.....................</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px 5px 5px 5px;"><b>Checklist</b></td>
                                <td style="padding: 5px 5px 5px 5px;"></td>
                                <td style="padding: 5px 5px 5px 5px;"></td>
                            </tr>
                            <?php $na = 1 ?>
                            @foreach($items['persyaratan'] as $d)
                            <tr>
                                <td style="padding: 5px 5px 5px 5px;"><?= $na ?>. <?= $d->nama_persyaratan ?></td>
                                <td style="padding: 5px 5px 5px 5px;"></td>
                                <td style="padding: 5px 5px 5px 5px;"><input type="checkbox"></td>
                            </tr>
                            <?php $na++ ?>


                            @endforeach
                            <tr style="height: 30pt">
                                <td style="padding: 5px 5px 5px 5px;"><b>Catatan</b>



                                </td>
                                <td style="padding: 5px 5px 5px 5px;"></td>
                                <td style="padding: 5px 5px 5px 5px;"></td>
                            </tr>
                            <tr style="height: 30pt">
                                <td style="padding: 5px 5px 5px 5px;"><br>
                                    <br><br>




                                </td>
                                <td style="padding: 5px 5px 5px 5px;"></td>
                                <td style="padding: 5px 5px 5px 5px;"></td>
                            </tr>

                        </table>
                        @else
                        <b>Layanan ini tidak mensyaratkan mengirimkan dokumen fisik persyaratan ke Disdukcapil sebelum pengajuan dapat diproses lebih lanjut </b>
                        @endif

                    </td>

                </tr>

                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold; text-align: center">Status Pengajuan</td>
                </tr>
                <tr valign="top">
                    <td colspan="2" style="padding: 10px 10px 10px 10px;">
                        <table width='100%'>
                            <thead>
                                <tr style="background-color: lightgray;">
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Status</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Tanggal</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Oleh</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Diinput</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                $dt = json_decode($items['pengajuan']->data_isian);
//                                $dtup = json_decode($items['pengajuan']->data_upload);
//                            print_r($dt);
                                $ns = 1;
                                ?>
                                @foreach($items['statuspengajuan'] as $keysss)
                                <tr >
                                    <td style="padding: 5px 5px 5px 5px;"><?= $ns ?>. <?= $keysss->nama_pengajuan ?></td>
                                    <td style="padding: 5px 5px 5px 5px; text-align: center"> 

                                        <?php
                                        $r = getHistoryStatus($items['pengajuan']->id, $keysss->id);
                                        ?>
                                        @if(count($r)>0)
                                        @foreach($r as $d)
                                        <?= tgltime_angka($d->created_at) ?>
                                        @endforeach
                                        @else
                                        .........................
                                        @endif

                                    </td>
                                    <td style="padding: 5px 5px 5px 5px; text-align: center"> 
                                        @if(count($r)>0)
                                        @foreach($r as $d)
                                        <?= ($d->processed_by) ?>
                                        @endforeach
                                        @else
                                        .........................
                                        @endif

                                    </td>
                                    <td width="5%" style="text-align: center;padding: 5px 5px 5px 5px;">
                                        @if(count($r)>0)
                                        @foreach($r as $d)
                                        <input type="checkbox" checked="" disabled="">
                                        @endforeach
                                        @else
                                        <input type="checkbox" disabled="">
                                        @endif

                                    </td>

                                </tr>
                                <?php $ns++ ?>
                                @endforeach
                                <tr style="height: 30pt">
                                    <td style="padding: 5px 5px 5px 5px;"><b>Catatan</b>



                                    </td>
                                    <td style="padding: 5px 5px 5px 5px;"></td>
                                    <td style="padding: 5px 5px 5px 5px;"></td>
                                </tr>
                                <tr style="height: 30pt">
                                    <td style="padding: 5px 5px 5px 5px;"><br>
                                        <br><br>




                                    </td>
                                    <td style="padding: 5px 5px 5px 5px;"></td>
                                    <td style="padding: 5px 5px 5px 5px;"></td>
                                </tr>
                            </tbody>
                        </table>

                    </td>

                </tr>
                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold; text-align: center">Status Proses</td>
                </tr>
                <tr valign="top">
                    <td colspan="2" style="padding: 10px 10px 10px 10px;">
                        <table width='100%'>
                            <thead>
                                <tr style="background-color: lightgray;">
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Status</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Tanggal</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Oleh</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Diinput</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                $dt = json_decode($items['pengajuan']->data_isian);
//                                $dtup = json_decode($items['pengajuan']->data_upload);
//                            print_r($dt);
                                $ns = 1;
                                ?>
                                @foreach($items['statusproses'] as $keysa)
                                <tr >
                                    <td style="padding: 5px 5px 5px 5px;"><?= $ns ?>. <?= $keysa->nama_proses ?></td>
                                    <td style="padding: 5px 5px 5px 5px; text-align: center"> 

                                        <?php
                                        $rq = getProsesStatus($items['pengajuan']->id, $keysa->nama_proses);
                                        ?>
                                        @if(count($rq)>0)
                                        @foreach($rq as $d)
                                        <?= tgltime_angka($d->created_at) ?>
                                        @endforeach
                                        @else
                                        .........................
                                        @endif

                                    </td>
                                    <td style="padding: 5px 5px 5px 5px;"> 
                                        @if(count($rq)>0)
                                        @foreach($rq as $d)
                                        <?= ($d->diproses_oleh) ?>
                                        @endforeach
                                        @else
                                        .........................
                                        @endif

                                    </td>
                                    <td width="5%" style="text-align: center;padding: 5px 5px 5px 5px;">
                                        @if(count($rq)>0)
                                        @foreach($rq as $d)
                                        <input type="checkbox" checked="" disabled="">
                                        @endforeach
                                        @else
                                        <input type="checkbox" disabled="">
                                        @endif
                                    </td>

                                </tr>
                                <?php $ns++ ?>
                                @endforeach
                                <tr style="height: 30pt">
                                    <td style="padding: 5px 5px 5px 5px;"><b>Catatan</b>



                                    </td>
                                    <td style="padding: 5px 5px 5px 5px;"></td>
                                    <td style="padding: 5px 5px 5px 5px;"></td>
                                </tr>
                                <tr style="height: 30pt">
                                    <td style="padding: 5px 5px 5px 5px;"><br>
                                        <br><br>




                                    </td>
                                    <td style="padding: 5px 5px 5px 5px;"></td>
                                    <td style="padding: 5px 5px 5px 5px;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold; text-align: center">Upload Dokumen Kependudukan Yang Bisa Didownload Pemohon
                    </td>
                </tr>
                <tr valign="top">
                    <td colspan="2" style="padding: 10px 10px 10px 10px;">
                        <table width='100%'>
                            <thead>
                                <tr style="background-color: lightgray;">
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Nama Dokumen</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Tanggal</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Oleh</th>
                                    <th style="text-align: center;padding: 10px 10px 10px 10px;">Diinput</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
//                                $dt = json_decode($items['pengajuan']->data_isian);
//                                $dtup = json_decode($items['pengajuan']->data_upload);
//                            print_r($dt);
                                $ns = 1;
                                ?>
                                @foreach($items['dokumenlayanan'] as $keys)
                                <tr >
                                    <td style="padding: 5px 5px 5px 5px;"><?= $ns ?>. <?= $keys->nama_dok_download ?></td>
                                    <td style="padding: 5px 5px 5px 5px; text-align: center"> 

                                        <?php
                                        $rqx = getUploadDokumen($items['pengajuan']->id);
                                        ?>
                                        @if(count($rqx)>0)
                                        @foreach($rqx as $d)
                                        <?= tgltime_angka($d->created_at) ?><br>
                                        @endforeach
                                        @else
                                        .........................  
                                        @endif

                                    </td>
                                    <td style="padding: 5px 5px 5px 5px; text-align: center"> 
                                        @if(count($rqx)>0)
                                        @foreach($rqx as $d)
                                        <?= ($d->uploaded_by) ?><br>
                                        @endforeach
                                        @else
                                        .........................  
                                        @endif

                                    </td>
                                    <td width="5%" style="text-align: center;padding: 5px 5px 5px 5px;">
                                        @if(count($rqx)>0)
                                        @foreach($rqx as $d)
                                        <input type="checkbox" checked="" disabled="">
                                        @endforeach
                                        @else
                                        <input type="checkbox" disabled="">
                                        @endif
                                    </td>

                                </tr>
                                <?php $ns++ ?>
                                @endforeach

                            </tbody>
                        </table>

                    </td>
                </tr>
                <tr style=" background-color: #AAA; ">
                    <td colspan="2"  style="padding: 10px 10px 10px 10px; border: #000 solid 1px;font-weight: bold; text-align: center">Opsi Pengiriman Dokumen
                    </td>
                </tr>
                <tr valign="top">
                    <td colspan="2" style="padding: 10px 10px 10px 10px;">
                        @if($items['pelayanan']->kirim_dok==1)

                        <b>Dokumen kependudukan dapat dikirimkan kepada pemohon via ekspedisi</b>
                        @else
                        <b>Dokumen kependudukan tidak dikirimkan kepada pemohon via ekspedisi</b>

                        @endif

                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>

