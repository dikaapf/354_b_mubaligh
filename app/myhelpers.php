<?php

use Illuminate\Support\Facades\DB;
use App\DataWni;
use App\DataKeluarga;
use App\Demographic;
use App\User;
use App\Historypengajuan;

function countBiodata() {
    return DataWni::count();
}

function countKeluarga() {
    return DataKeluarga::count();
}

function countPengajuanNew() {
    return \App\Pengajuan::where('status_pengajuan', '=', 1)->count();
}

function countPengajuan() {
    return \App\Pengajuan::count();
}

function countUserNew() {
    return User::where('status_user', '=', 0)->count();
}

function countUser() {
    return User::where('status_user', '=', 1)->count();
}

function countWajib() {
    $PDO = DB::connection('oracle_siak')->getPdo();
    $x = $PDO->prepare("
        select 
            count(*)count
            from BIODATA_WNI_201902
            where ((floor(months_between(sysdate,TGL_LHR)/12)>=17) OR (stat_kwn>1))
            
     ");

    $x->execute();
    $data = $x->fetchAll((\PDO::FETCH_OBJ));
    return ($data[0]->count);
}

function countWajibAkta() {
    $PDO = DB::connection('oracle_siak')->getPdo();
    $x = $PDO->prepare("
        select 
            count(*)count
            from BIODATA_WNI_201902
            where ((floor(months_between(sysdate,TGL_LHR)/12)<=18))
            
     ");

    $x->execute();
    $data = $x->fetchAll((\PDO::FETCH_OBJ));
    return ($data[0]->count);
}

function listStatusPengajuan($kode) {

    switch ($kode) {
        case 1:

            return $list = [
                '' => 'Pilih status pengajuan',
                '2' => 'Pengajuan disetujui untuk di proses',
                '3' => 'Pengajuan diproses',
                '4' => 'Pengajuan dibatalkan',
            ];
            break;

        case 2:

            return $list = [
                '' => 'Pilih status pengajuan',
                '3' => 'Pengajuan diproses',
                '4' => 'Pengajuan dibatalkan',
            ];
            break;
        case 3:

            return $list = [
                '' => 'Pilih status pengajuan',
                '4' => 'Pengajuan dibatalkan',
                '5' => 'Pengajuan Selesai',
            ];
            break;
        case 4:

            return $list = [
                '' => 'Pengajuan telah dibatalkan',
            ];
            break;
        default:
            break;
    }
}

function listProsesPengajuan($kode) {
    $list = DB::table('soplayanans')
            ->select([DB::raw('*')])
            ->where('jenislayanan_id', '=', $kode)
            ->orderBy('id', 'asc')
            ->get();

    foreach ($list as $data) {
        $d[$data->nama_proses] = $data->nama_proses . " ($data->deskripsi_proses) ";
    }
    return $d;
}

function listDokumen() {
    $list = DB::table('dokumens')
            ->select([DB::raw('*')])
            ->orderBy('id', 'asc')
            ->get();
    $d[''] = 'Pilih';

    foreach ($list as $data) {
        $d[$data->nama_dokumen] = $data->nama_dokumen;
    }
    return $d;
}

function getJenisSUrat($no) {
    $r = DB::table('kategorisurats')
            ->select([DB::raw('jenis_surat')])
            ->where('id', '=', $no)
            ->first();
    return $r->jenis_surat;
}

function getIdBioSuku($nik) {
    $r = DB::table('BIODATA_SUKUS')
            ->select([DB::raw('id')])
            ->where('nik', '=', $nik)
            ->get();
    return $r[0]->id;
}

function getOptionWni($sect, $no) {
    $r = DB::table('OPTIONS_WNI')
            ->select([DB::raw('descr')])
            ->where('sect', '=', $sect)
            ->where('no', '=', $no)
            ->get();
    return $r[0];
}

function listDistrik() {
    $r = DB::table('SIAKOFF.setup_kec')
            ->select([DB::raw('*')])
            ->where('no_prop', '=', 91)
            ->where('no_kab', '=', 2)
            ->orderBy('no_kec', 'ASC')
            ->get();
    return $r;
}

function getDistrik($kec) {
    $r = DB::table('SIAKOFF.setup_kec')
            ->select([DB::raw('nama_kec')])
            ->where('no_prop', '=', 91)
            ->where('no_kab', '=', 2)
            ->where('no_kec', '=', $kec)
            ->get();
    return $r[0]->nama_kec;
}

function getNamasuku($id) {
    $r = DB::table('SIAKOFF.setup_sukudaerahs')
            ->select([DB::raw('nama_suku')])
            ->where('id', '=', $id)
            ->get();
    return $r[0]->nama_suku;
}

function getSukuProp($id) {
    $r = DB::table('SIAKOFF.setup_sukudaerahs')
            ->select([DB::raw('no_prop')])
            ->where('id', '=', $id)
            ->get();
    return $r[0]->no_prop;
}

function getNamaDistrik($kec) {
    $r = DB::table('SIAKOFF.setup_kec')
            ->select([DB::raw('nama_kec')])
            ->where('no_prop', '=', 91)
            ->where('no_kab', '=', 2)
            ->where('no_kec', '=', $kec)
            ->get();
    return $r[0]->nama_kec;
}

function getKampung($kec, $kel) {
    $r = DB::table('SIAKOFF.setup_kel')
            ->select([DB::raw('nama_kel')])
            ->where('no_prop', '=', 91)
            ->where('no_kab', '=', 2)
            ->where('no_kec', '=', $kec)
            ->where('no_kel', '=', $kel)
            ->get();
    return $r[0]->nama_kel;
}

function getSetupApp() {
    $r = DB::table('SETUP_APLIKASI')
            ->select([DB::raw('NO_PROP,NO_KAB')])
            ->get();
    return $r;
}

function InsertMarga($marga) {
    $tr = new MargaAll();
    $tr->nama_marga = $marga;
    if ($tr->save()) {
        return 1;
    } else {
        return 0;
    }
}

function cekNoKk($nokk) {
    return DataKeluarga::
                    where('no_kk', '=', $nokk)
                    ->count();
}

function jumCetakKtp($tgl) {
    $PDO = DB::connection('pgsql')->getPdo();
    $x = $PDO->prepare("
        select count(created) from transaksi_daftar_ktps
join transaksi_daftars on transaksi_daftar_ktps.transaksidaftar_id = transaksi_daftars.id 
where created='" . $tgl . "'
GROUP BY created
order by created asc
        
     ");

    $x->execute();
    $data = $x->fetchAll((\PDO::FETCH_OBJ));
    return ($data[0]->count);
}

function jumKtp($id) {
    return TransaksiDaftarKtp::
                    where('transaksidaftar_id', '=', $id)
                    ->count();
}

function getKtp($id) {
    return TransaksiDaftarKtp::
                    where('transaksidaftar_id', '=', $id)
                    ->get();
}

function ambilKeterangan($id) {
    $t = TransaksiDaftarKtp::
            where('id', '=', $id)
            ->get();
    return $t[0]->keterangan;
}

function getTransaksi($id) {
    return TransaksiDaftar::
                    where('id', '=', $id)
                    ->get();
}

function getNamaKep($no_kk) {
    $t = DataKeluarga::
            where('no_kk', '=', $no_kk)
            ->get();
    return $t[0]->nama_kep;
}

function getBiodata($nik) {
    $t = DataWni::
            where('nik', '=', $nik)
            ->get();
    return $t[0];
}

function getNama($nik) {
    $r = DB::connection('oracle1')->table('biodata_wni')
            ->select([DB::raw('nama_lgkp')])
            ->where('biodata_wni.nik', '=', $nik)
            ->first();
    if (count($r) == 0) {
        return 'TIDAK DITEMUKAN';
    } else {
        return $r->nama_lgkp;
    }
}

function getDemograhic($nik) {
    $r = DB::connection('oracle3')->table('demographics')
            ->select([DB::raw('nik,nama_lgkp,tmpt_lhr,nama_prop,'
                        . 'nama_kab,nama_kec,nama_kel,agama,jenis_klmin,'
                        . 'gol_drh,stat_kwn,tgl_lhr,current_status_code,created,'
                        . 'jenis_pkrjn,no_kk,nama_kep,alamat,dusun,kode_pos')])
            ->where('demographics.nik', '=', $nik)
            ->first();
    return $r[0];
}

function ambilDemograhic($nik) {
    $r = DB::connection('oracle3')->table('demographics')
            ->select([DB::raw('*')])
            ->where('demographics.nik', '=', $nik)
            ->get();
    return $r;
}

function ambilDemograhicOrcl($nik) {
    $r = DB::connection('oracle4')->table('demographics')
            ->select([DB::raw('*')])
            ->where('demographics.nik', '=', $nik)
            ->get();
    return $r;
}

function timestamp2date($date) {
    //2016-07-18 14:29:33

    return substr($date, 0, 10);
}

function tgl_kehari($tanggal = null) {
    $day = date('l', strtotime($tanggal));
    $dayList = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    );
    return $dayList[$day] . ", " . tgl_indo($tanggal);
}

function tgl_indo($tanggal, $trim = null) {
    //2015-10-10
    if ($trim != null) {
        $bln = bulan(substr($tanggal, 5, 2));
        return substr($tanggal, 8, 2) . " " . substr($bln, 0, $trim) . " " . substr($tanggal, 0, 4);
    } else {
        return substr($tanggal, 8, 2) . " " . strtoupper(bulan(substr($tanggal, 5, 2))) . " " . substr($tanggal, 0, 4);
    }
}

function tgltime_indo($tanggal, $trim = null) {
    //2015-10-10
    $time = substr($tanggal, -8);
    if ($trim != null) {
        $bln = bulan(substr($tanggal, 5, 2));
        return substr($tanggal, 8, 2) . " " . substr($bln, 0, $trim) . " " . substr($tanggal, 0, 4) . ' ' . $time;
    } else {
        return substr($tanggal, 8, 2) . " " . strtoupper(bulan(substr($tanggal, 5, 2))) . " " . substr($tanggal, 0, 4) . ' ' . $time;
    }
}

function tgltime_angka($tanggal, $trim = null) {
    //2015-10-10
    $time = substr($tanggal, -8);
    return substr($tanggal, 8, 2) . "-" . substr($tanggal, 5, 2) . "-" . substr($tanggal, 0, 4) . ' ' . $time;
}

function tgl_angka($tanggal) {
    //2015-10-10
    return substr($tanggal, 8, 2) . "-" . substr($tanggal, 5, 2) . "-" . substr($tanggal, 0, 4);
}

function tgl_mysql($tanggal) {
    //10-12-2010
    return substr($tanggal, 6, 4) . "-" . substr($tanggal, 3, 2) . "-" . substr($tanggal, 0, 2);
}

function tgl_pendek($tanggal) {
    return substr($tanggal, 8, 2) . " " . substr(bulan(substr($tanggal, 5, 2)), 0, 3);
}

function getTahun($tanggal) {
    return substr($tanggal, 0, 4);
}

function bulan($bulan) {
    switch ($bulan) {
        case 1:
            return "Januari";

            break;
        case 2:
            return "Pebruari";

            break;
        case 3:
            return "Maret";

            break;
        case 4:
            return "April";

            break;
        case 5:
            return "Mei";

            break;
        case 6:
            return "Juni";

            break;
        case 7:
            return "Juli";

            break;
        case 8:
            return "Agustus";

            break;
        case 9:
            return "September";

            break;
        case 10:
            return "Oktober";

            break;
        case 11:
            return "November";

            break;
        case 12:
            return "Desember";

            break;
        default:
            break;
    }
}

function generateHari($month, $year) {
    $list = array();
    $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    for ($d = 1; $d <= $number; $d++) {
        $time = mktime(12, 0, 0, $month, $d, $year);
        if (date('m', $time) == $month) {
            switch (date('D', $time)) {
                case 'Mon':

                    $hari = 'Senin';
                    break;
                case 'Tue':

                    $hari = 'Selasa';
                    break;
                case 'Wed':

                    $hari = 'Rabu';
                    break;
                case 'Thu':

                    $hari = 'Kamis';
                    break;
                case 'Fri':

                    $hari = 'Jum\'mat';
                    break;
                case 'Sat':

                    $hari = 'Sabtu';
                    break;
                case 'Sun':

                    $hari = 'Minggu';
                    break;


                default:
                    break;
            }
            $list[] = $hari . date(', d-m-Y', $time);
        }
    }
    return $list;
}

function bersihkan($string) {
    return $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
}

function clean($string) {
    $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
    $string = str_replace('/', '_', $string); // Replaces all spaces with hyphens.
    $string = str_replace('.', '_', $string); // Replaces all spaces with hyphens.
    return $string = str_replace('\'', '_', $string); // Replaces all spaces with hyphens.
//     $string = str_replace(',', '', $string); // Replaces all spaces with hyphens.
//    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function clean_tgl($string) {
    //06-01-2016
    $unix = strtotime($string);
    return date('j-n-Y', $unix);
}

function romawi($angka) {
    switch ($angka) {
        case 1:
            return "I";

            break;
        case 2:
            return "II";

            break;
        case 3:
            return "III";

            break;
        case 4:
            return "IV";

            break;
        case 5:
            return "V";

            break;
        case 6:
            return "VI";

            break;
        case 7:
            return "VII";

            break;
        case 8:
            return "VIII";

            break;
        case 9:
            return "IX";

            break;
        case 10:
            return "X";

            break;
        case 11:
            return "XI";

            break;
        case 12:
            return "XII";

            break;
        default:
            break;
    }
}

function agama($kode) {
    switch ($kode) {
        case 1:
            return "Islam";
            break;
        case 2:
            return "Protestan";
            break;
        case 3:
            return "Katholik";
            break;
        case 4:
            return "Hindu";
            break;
        case 5:
            return "Budha";
            break;
        case 6:
            return "Konghucu";
            break;
        case 7:
            return "Kepercayaan";
            break;

        default:
            break;
    }
}

function getFlagStatus($kode) {
    switch ($kode) {
        case 0:
            return "AKTIF";
            break;
        case 1:
            return "MATI";
            break;
        case 2:
            return "PROSES PINDAH";
            break;
        case 4:
            return "GANDA";
            break;
        case 'L':
            return "ANOMALI";
            break;
        case 'K':
            return "TIDAK AKTIF";
            break;
        case 8:
            return "PINDAH";
            break;

        default:
            break;
    }
}

function getVerifikasi($kode) {
    switch ($kode) {
        case 0:
            return "BELUM DI VERIFIKASI";
            break;
        case 1:
            return "TERVERIFIKASI";
            break;
        case 2:
            return "PENDING";
            break;

        default:
            break;
    }
}

function getStatus($kode) {
    switch ($kode) {
        case 0:
            return "Non Aktif";
            break;
        case 1:
            return "Aktif";
            break;

        default:
            break;
    }
}

function setStatusPengajuan($kode) {
    switch ($kode) {
        case 1:
            return '<span class="label label-primary">Pengajuan baru</span>';
            break;
        case 2:
            return '<span class="label label-inverse">Pengajuan disetujui</span> ';
            break;
        case 3:
            return '<span class="label label-info">Pengajuan diproses</span>';
            break;
        case 4:
            return '<span class="label label-danger">Pengajuan dibatalkan</span>';
            break;
        case 5:
            return '<span class="label label-success">Pengajuan selesai</span>';
            break;

        default:
            break;
    }
}

function hitungSelisih($tglawal) {

    $thn = $tglawal / 12;
    $bln = $tglawal % 12;
    return (int) $thn . " tahun, " . $bln . " bulan.";
}

function bersikan_spasi($string) {
    return str_replace("  ", " ", $string);
}

function explnama($nama) {
    return explode(" ", ($nama));
}

function getPenduduk($prov, $kab, $kec, $kel) {
    $r = DB::table('SIAKOFF.biodata_wni_201602')
            ->select([DB::raw('*')])
            ->where('no_prop', '=', $prov)
            ->where('no_kab', '=', $kab)
            ->where('no_kec', '=', $kec)
            ->where('no_kel', '=', $kel)
            ->get();
    return $r;
}

function hitung_jnama($marga, $kec) {
//    return DataDkb::where('nama_lgkp', 'like', '%' . $marga)
    return Margakec::where('nama_marga', '=', $marga)
                    ->where('no_kec', '=', $kec)
                    ->count();
}

function hitung_jnamaA($marga) {
//    return DataDkb::where('nama_lgkp', 'like', '%' . $marga)
    return Margakec::where('nama_marga', '=', $marga)
//                    ->where('no_kec', '=', $kec)
                    ->count();
}

function cleanString($string) {
    $string = str_replace('/', '', $string); // Replaces all spaces with hyphens.
    $string = str_replace('.', '', $string); // Replaces all spaces with hyphens.
    $string = str_replace('\'', '', $string); // Replaces all spaces with hyphens.
    $string = str_replace(',', '', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function getRekamTahun($tahun) {
    $PDO = DB::connection('oracle1')->getPdo();
    $billingStmt = $PDO->prepare("
    
          select  EXTRACT(year FROM created) tahun, EXTRACT(month FROM created) bulan,count(created)jumlah
            from demographics
            where EXTRACT(year FROM created)=" . $tahun . "
            group by EXTRACT(year FROM created), EXTRACT(month FROM created)
            order by  EXTRACT(year FROM created),EXTRACT(month FROM created) asc
 
          ");
    $billingStmt->execute();
    return $billingStmt->fetchAll((\PDO::FETCH_OBJ));
}

function mylicense() {
    return '<div class="pull-right">
                        Hak Cipta Aplikasi<br>Abd. Rahman - 197909212009041003 - Disdukcapil Kab. Jayawijaya
                        
                    </div>';
}

function listPropinsi() {
    $list = DB::connection('oracle1')
            ->table('setup_prop')
            ->select([DB::raw('no_prop, nama_prop')])
            ->where('no_prop', '=', setDataInstansi()->no_prop)
            ->get();
    foreach ($list as $data) {
        $d[$data->no_prop] = $data->nama_prop;
    }
    return $d;
}

function countMasuk($tgl) {
    return DB::table('suratmasuks')
                    ->where('tgl_terima', '=', $tgl)
                    ->count();
}

function countMasukBln($bln) {
    $PDO = DB::connection('mysql')->getPdo();
    $billingStmt = $PDO->prepare("
    
          SELECT count(*)jumlah FROM suratmasuks WHERE month(tgl_surat)=" . $bln . " 
 
          ");
    $billingStmt->execute();
    $r = $billingStmt->fetchAll((\PDO::FETCH_OBJ));
    return($r[0]->jumlah);
}

function countKel($no_prop, $no_kab) {
    return DB::connection('oracle1')
                    ->table('setup_kel')
                    ->where('no_prop', '=', $no_prop)
                    ->where('no_kab', '=', $no_kab)
                    ->count();
}

function countAgregat($no_prop, $no_kab) {
    return DB::connection('oracle1')
                    ->table(setDataInstansi()->default_dkb)
                    ->where('no_prop', '=', $no_prop)
                    ->count();
}

function countDatang($tahun) {
    $PDO = DB::connection('oracle1')->getPdo();
    $billingStmt = $PDO->prepare("
    
          select count(created_date) jumlah
from datang_header
where EXTRACT(year FROM created_date)=" . $tahun . "
 
          ");
    $billingStmt->execute();
    $r = $billingStmt->fetchAll((\PDO::FETCH_OBJ));
    return($r[0]->jumlah);
}

function listTahunCapilLahir() {
    $PDO = DB::connection('oracle1')->getPdo();
    $billingStmt = $PDO->prepare("
    
          select EXTRACT(year FROM adm_akta_tgl) tahun
from capil_lahir
group by EXTRACT(year FROM adm_akta_tgl)
order by EXTRACT(year FROM adm_akta_tgl)
 
          ");
    $billingStmt->execute();
    $list = $billingStmt->fetchAll((\PDO::FETCH_OBJ));

    $d[''] = 'Pilih Tahun';
    foreach ($list as $data) {
        $d[$data->tahun] = $data->tahun;
    }
    return $d;
}

function GetVolumeLabel($drive) {
    if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir ' . $drive . ':'), $m)) {
        $volname = ' (' . $m[1] . ')';
    } else {
        $volname = '';
    }
    return $volname;
}

function getEntryKk($tanggal) {
    return DB::table('data_keluarga')
                    ->select(DB::raw('NO_KK, NAMA_KEP, ALAMAT, 
   NO_RT, NO_RW, DUSUN, 
   KODE_POS, TELP, ALS_PRMOHON, 
   ALS_NUMPANG, NO_PROP, NO_KAB, 
   NO_KEC, NO_KEL, USERID, 
   TGL_INSERTION, TGL_UPDATION, PFLAG, 
   CFLAG, SYNC_FLAG, OA_NAMA_PERTAMA, 
   OA_NAMA_KELUARGA, TIPE_KK, NIK_KK, 
   COUNT_KK, FLAGSINK, TGL_SIAK_PLUS, 
   SMS_PHONE, SMS_COUNT, MODIFIED_BY, 
   CREATED_BY, NAMA_PET_REG, NIP_PET_REG, 
   NAMA_PET_ENTRI, NIP_PET_ENTRI, FLAG_PINDAH,getnamakec(no_kec,no_kab,no_prop) nama_kec,
   getnamakel(no_kel,no_kec,no_kab,no_prop)namadesa_kel'))
                    ->where('tgl_insertion', '>=', $tanggal)
//                     ->groupBy('tgl_entri')
                    ->get();
}

function listTahunKk() {
    $PDO = DB::connection('oracle1')->getPdo();
    $billingStmt = $PDO->prepare("
    
          select EXTRACT(year FROM tgl_insertion) tahun
from capil_lahir
group by EXTRACT(year FROM tgl_insertion)
order by EXTRACT(year FROM tgl_insertion)
 
          ");
    $billingStmt->execute();
    $list = $billingStmt->fetchAll((\PDO::FETCH_OBJ));

    $d[''] = 'Pilih Tahun';
    foreach ($list as $data) {
        $d[$data->tahun] = $data->tahun;
    }
    return $d;
}

function cekPengajuanDwh($nik) {
    return $no_id = App\Updatedwhs::where('nik', '=', $nik)
            ->get();
}

function statusDwh($angka) {
    switch ($angka) {
        case 1:
            return "<label class='label label-warning'>Diajukan</label>";

            break;
        case 2:
            return "<label class='label label-success'>Selesai</label>";

            break;

        default:
            break;
    }
}

function Logpengajuan($id, $status, $catatan, $by) {

    Historypengajuan::create([
        'pengajuan_id' => $id,
        'status_pengajuan' => $status,
        'catatan' => $catatan,
        'processed_by' => $by
    ]);
}

function LogProses($id, $status, $catatan, $by) {

    \App\Riwayatprose::create([
        'pengajuan_id' => $id,
        'nama_proses' => $status,
        'catatan' => $catatan,
        'diproses_oleh' => $by,
    ]);
}

function getStatusPengajuan($no) {
    $r = DB::table('statuspengajuans')
            ->select([DB::raw('nama_pengajuan')])
            ->where('id', '=', $no)
            ->get();

//    print_r($r);
    foreach ($r as $d) {
        return ($d->nama_pengajuan);
    }
}

function getHistoryStatus($pengajuan_id, $status) {
    return Historypengajuan::select([DB::raw('*')])
                    ->where('pengajuan_id', '=', $pengajuan_id)
                    ->where('status_pengajuan', '=', $status)
                    ->get();
}

function getProsesStatus($pengajuan_id, $nama_proses) {
    return App\Riwayatprose::select([DB::raw('*')])
                    ->where('pengajuan_id', '=', $pengajuan_id)
                    ->where('nama_proses', '=', $nama_proses)
                    ->get();
}

function getUploadDokumen($pengajuan_id) {
    return App\Uploaddok::select([DB::raw('*')])
                    ->where('pengajuan_id', '=', $pengajuan_id)
                    ->get();
}
