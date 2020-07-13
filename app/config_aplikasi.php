<?php

function setDataInstansi() {
    $data = simplexml_load_file(asset('config_dokumen.xml'));
    $json = json_encode($data);
    $configData = json_decode($json, true);

    return (object) $configData['data'];
}

//SESUAIKAN DENGAN DATA DKB YANG SUDAH DI IMPORT DI DATABASE SIAK
function listDKB() {
    $d = array(
        'biodata_wni_201601' => 'Tahun 2016 Semester I',
        'biodata_wni_201602' => 'Tahun 2016 Semester II',
        'biodata_wni_201701' => 'Tahun 2017 Semester I',
        'biodata_wni_201702_ok' => 'Tahun 2017 Semester II',
        'biodata_wni' => 'Biodata WNI (transaksi)',
    );

    return $d;
}
function listCapil() {
    $d = array(
        'capil_lahir' => 'Kelahiran',
        'capil_kawin' => 'Perkawinan',
        'capil_cerai' => 'Perceraian',
        'capil_mati' => 'Kematian',
    );

    return $d;
}

