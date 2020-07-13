<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin', [
            'except' => [
                'indexdistrik',
                'indexpeta'
        ]]);
    }

    public function agg_by_desa() {
        $data['agregat'] = null;
        return view('data.agregat.by_desa', $data);
    }

    public function post_by_desa() {
//        return Input::all();

        $r = getSetupApp();
        $data['agregat'] = DB::table(Input::get('t_dkb'))
                ->select(DB::raw(" (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
getnamakec(no_kec,no_kab,no_prop) nama_kec,
(no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||trim(to_char(no_kec,'00'))||'.'||no_kel)kdkel,
getnamakel(no_kel,no_kec,no_kab,no_prop)namadesa_kel,
count(*)jumlah_penduduk"))
                ->where('no_prop', '=', $r[0]->no_prop)
                ->where('no_kab', '=', $r[0]->no_kab)
                ->groupBy('no_prop')
                ->groupBy('no_kab')
                ->groupBy('no_kec')
                ->groupBy('no_kel')
                ->orderBy('no_kec')
                ->orderBy('no_kel')
                ->get();
        $data['tahun'] = listDKB()[Input::get('t_dkb')];
        $this->cetakxls_by_desa(Input::get('t_dkb'), $data['agregat']);
        return view('data.agregat.by_desa', $data);
    }

    public function cetakxls_by_desa($dkb, $data) {

        $fff['tabel'] = $dkb;
        $fff['data'] = $data;
        Excel::create('jumlah_penduduk_tingkat_desa_kel', function($excel) use($fff) {


            $d['tabel'] = $fff['tabel'];
            $d['data'] = $fff['data'];
            $excel->sheet("Cek", function($sheet) use($d) {

                $row = 1;
                $no = 1;
                $sheet->cells('A1:F4', function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                });
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->mergeCells('A3:F3');
                $sheet->mergeCells('A4:F4');
                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row($row, array(
                    setDataInstansi()->instansi
                ));


                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    setDataInstansi()->opd
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    "JUMLAH PENDUDUK TINGKAT KAMPUNG " . strtoupper(listDKB()[$d['tabel']])
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    " " . strtoupper(listDKB()[$d['tabel']])
                ));
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                ++$row;
                $rowawal = $row;
                $sheet->cells("A$row:F$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'No', 'Kode Kec', 'Nama Kec', 'Kode Kel', 'Nama Kel', 'Jumlah',
                ));



                $d['paket'] = $d['data'];
                $row_ht = $row;
                foreach ($d['paket'] as $dt) {
                    $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                    );
                    $sheet->row(++$row, array(
                                $no,
                                $dt->kdkec,
                                $dt->nama_kec,
                                $dt->kdkel,
                                $dt->namadesa_kel,
                                ($dt->jumlah_penduduk),
                            ))
                            ->setHeight($row, 15);
                    $no++;
                }
                $row_ak = $row;
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                $sheet->mergeCells("A$row:E$row");
                $sheet->getStyle('F' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'right')
                );
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                $sheet->cells("A$row:F$row", function($cells) {
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'Jumlah', '', '', '', '', "=sum(F$row_ht:F$row_ak)",
                ));

                $sheet->setColumnFormat(array(
                    'F' => '0.00',
                ));
                $sheet->setBorder("A$rowawal:F$row", 'thin');
                $sheet->setAutoSize(true);
                $sheet->setWidth(array(
                    'A' => 8,
                    'B' => 10,
                    'C' => 30,
                    'D' => 15,
                    'E' => 30,
                    'F' => 10
                ));


                ++$row;
//                $sheet->getStyle("B$row:B$row")->getAlignment()->setWrapText(true);

                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->tempat_surat . ", " . date('d-m-Y')
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->pejabat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->opd
                        ))
                        ->setHeight($row, 15);
                ++$row;
                ++$row;
                ++$row;
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nama_ttd_surat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nip_surat
                        ))
                        ->setHeight($row, 15);
            });
        })->store('xlsx', public_path('files'), false);
//                ->download('xlsx');
    }

//post_by_desa_jk
    public function post_by_desa_jk() {
//        return Input::all();

        $r = getSetupApp();
        $data['agregat'] = DB::table(Input::get('t_dkb'))
                ->select(DB::raw(" (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
getnamakec(no_kec,no_kab,no_prop) nama_kec,
(no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||trim(to_char(no_kec,'00'))||'.'||no_kel)kdkel,
getnamakel(no_kel,no_kec,no_kab,no_prop)namadesa_kel,
count(decode(jenis_klmin,1,1))lk,
count(decode(jenis_klmin,2,1))pr,
count(*)jumlah_penduduk"))
                ->where('no_prop', '=', $r[0]->no_prop)
                ->where('no_kab', '=', $r[0]->no_kab)
                ->groupBy('no_prop')
                ->groupBy('no_kab')
                ->groupBy('no_kec')
                ->groupBy('no_kel')
                ->orderBy('no_kec')
                ->orderBy('no_kel')
                ->get();
        $data['tahun'] = listDKB()[Input::get('t_dkb')];
        $this->cetakxls_by_desa_jk(Input::get('t_dkb'), $data['agregat']);
        return view('data.agregat.by_desa_jk', $data);
    }

    public function cetakpdf_by_desa(Request $request, $tbl) {
        $tbl;
        $r = getSetupApp();
        $data['agregat'] = DB::table($tbl)
                ->select(DB::raw(" (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
getnamakec(no_kec,no_kab,no_prop) nama_kec,
(no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||trim(to_char(no_kec,'00'))||'.'||no_kel)kdkel,
getnamakel(no_kel,no_kec,no_kab,no_prop)namadesa_kel,
count(*)jumlah_penduduk"))
                ->where('no_prop', '=', $r[0]->no_prop)
                ->where('no_kab', '=', $r[0]->no_kab)
                ->groupBy('no_prop')
                ->groupBy('no_kab')
                ->groupBy('no_kec')
                ->groupBy('no_kel')
                ->orderBy('no_kec')
                ->orderBy('no_kel')
                ->get();
        $data['tahun'] = listDKB()[$tbl];

        view()->share('items', $data);
//        if ($request->has('download')) {
//            $customPaper = array(0, 0, 609, 935);
//            $pdf = PDF::loadView('data.agregat.by_desa_cetak')->setPaper($customPaper, 'portrait')->setWarnings(false);
//
//            return $pdf->download('agregat_penduduk.pdf');
//        }
        return view('data.agregat.by_desa_cetak', $data);
    }

    public function cetakxls_by_desa_jk($dkb, $data) {

        $fff['tabel'] = $dkb;
        $fff['data'] = $data;
        Excel::create('jumlah_penduduk_kampung_jk', function($excel) use($fff) {


            $d['tabel'] = $fff['tabel'];
            $d['data'] = $fff['data'];
            $excel->sheet("Cek", function($sheet) use($d) {

                $row = 1;
                $no = 1;
                $sheet->cells('A1:H4', function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                });
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                $sheet->mergeCells('A3:H3');
                $sheet->mergeCells('A4:H4');
                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row($row, array(
                    setDataInstansi()->instansi
                ));


                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    setDataInstansi()->opd
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    "JUMLAH PENDUDUK TINGKAT KAMPUNG " . strtoupper(listDKB()[$d['tabel']])
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    " " . strtoupper(listDKB()[$d['tabel']])
                ));
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                ++$row;
                $rowawal = $row;
                $sheet->cells("A$row:H$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'No', 'Kode Kec', 'Nama Kec', 'Kode Kel', 'Nama Kel', 'LK', 'PR', 'Jumlah',
                ));



                $d['paket'] = $d['data'];
                $row_ht = $row;
                foreach ($d['paket'] as $dt) {
                    $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                    );
                    $sheet->row(++$row, array(
                                $no,
                                $dt->kdkec,
                                $dt->nama_kec,
                                $dt->kdkel,
                                $dt->namadesa_kel,
                                $dt->lk,
                                $dt->pr,
                                ($dt->jumlah_penduduk),
                            ))
                            ->setHeight($row, 15);
                    $no++;
                }
                $row_ak = $row;
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                $sheet->mergeCells("A$row:E$row");
                $sheet->getStyle('H' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'right')
                );
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                $sheet->cells("A$row:H$row", function($cells) {
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'Jumlah', '', '', '', '', "=sum(F$row_ht:F$row_ak)", "=sum(G$row_ht:G$row_ak)", "=sum(H$row_ht:H$row_ak)",
                ));

                $sheet->setColumnFormat(array(
                    'F' => '0.00',
                ));
                $sheet->setBorder("A$rowawal:H$row", 'thin');
                $sheet->setAutoSize(true);
                $sheet->setWidth(array(
                    'A' => 8,
                    'B' => 10,
                    'C' => 30,
                    'D' => 15,
                    'E' => 30,
                    'F' => 10
                ));


                ++$row;
//                $sheet->getStyle("B$row:B$row")->getAlignment()->setWrapText(true);

                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->tempat_surat . ", " . date('d-m-Y')
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->pejabat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->opd
                        ))
                        ->setHeight($row, 15);
                ++$row;
                ++$row;
                ++$row;
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nama_ttd_surat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nip_surat
                        ))
                        ->setHeight($row, 15);
            });
        })->store('xlsx', public_path('files'), false);
//                ->download('xlsx');
    }

    public function bckp($dkb) {
        $fff = $dkb;
        Excel::create('Data Penduduk tingkat Kecamatan', function($excel) use($fff) {


            $d['tabel'] = $fff;
            $excel->sheet("Cek", function($sheet) use($d) {

                $row = 6;
                $no = 1;
                $sheet->mergeCells('A1:E1');
                $sheet->mergeCells('A2:E2');
                $sheet->mergeCells('A3:E3');
                $sheet->cells('A1:E3', function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '13',
                        'bold' => true
                    ));
                });
                $sheet->row(1, array(
                    'PEMERINTAH KABUPATEN JAYAWIJAYA'
                ));
                $sheet->row(2, array(
                    'DINAS KEPENDUDUKAN DAN CATATAN SIPIL'
                ));

                $sheet->row(3, array(
                    "JUMLAH PENDUDUK TINGKAT KAMPUNG " . $d['tabel']
                ));
                $sheet->mergeCells('A5:A6');
                $sheet->mergeCells('B5:B6');
                $sheet->mergeCells('A5:A6');
                $sheet->mergeCells('E5:E6');
                $sheet->mergeCells('C5:D5');
                $sheet->cells("A5:E6", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row(5, array(
                    'No', 'Kecamatan', 'Jenis Kelamin', '', 'Jumlah',
                ));
                $sheet->cells("C6:D6", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row(6, array(
                    '',
                    '',
                    'L',
                    'P',
                ));
                $PDO = DB::connection('oracle1')->getPdo();
                $x = $PDO->prepare("
                    select (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
                   getnamakec(no_kec,no_kab,no_prop) nama_kec,
                   count(decode(jenis_klmin,1,1))lk,
                   count(decode(jenis_klmin,2,1))pr,
                   count(*)jumlah_penduduk
                   from " . $d['tabel'] . " 
                   where no_prop=91 and no_kab=02
                   group by no_prop,no_kab,no_kec
                   order by no_kec
                    ");

                $x->execute();
                $d['paket'] = $x->fetchAll((\PDO::FETCH_OBJ));
                foreach ($d['paket'] as $dt) {
                    $sheet->getStyle('C' . $row)->getAlignment()->applyFromArray(
                            array('horizontal' => 'right')
                    );
                    $sheet->row( ++$row, array(
                                $no,
                                $dt->nama_kec,
                                $dt->lk,
                                $dt->pr,
                                doubleval($dt->jumlah_penduduk),
                            ))
                            ->setHeight($row, 15);
                    $no++;
                }



                $sheet->setBorder("A5:E$row", 'thin');
                $sheet->setAutoSize(true);
                $sheet->setWidth(array(
                    'A' => 8,
                    'B' => 30,
                    'C' => 10,
                    'D' => 10,
                    'E' => 10
                ));
                $sheet->getStyle("B8:B$row")->getAlignment()->setWrapText(true);
                $sheet->row( ++$row, array(
                            "Sumber Data : SIAK",
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            "Tanggal Cetak : " . date("d-m-Y"),
                        ))
                        ->setHeight($row, 15);
            });
        })->download('xlsx');
    }

//aggregat by desa jk
    public function agg_by_desa_jk() {
        $data['agregat'] = null;
        return view('data.agregat.by_desa_jk', $data);
    }

    public function cetakpdf_by_desa_jk(Request $request, $tbl) {
        $tbl;
        $r = getSetupApp();
        $data['agregat'] = DB::table($tbl)
                ->select(DB::raw(" (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
getnamakec(no_kec,no_kab,no_prop) nama_kec,
(no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||trim(to_char(no_kec,'00'))||'.'||no_kel)kdkel,
getnamakel(no_kel,no_kec,no_kab,no_prop)namadesa_kel,
count(decode(jenis_klmin,1,1))lk,
count(decode(jenis_klmin,2,1))pr,
count(*)jumlah_penduduk"))
                ->where('no_prop', '=', $r[0]->no_prop)
                ->where('no_kab', '=', $r[0]->no_kab)
                ->groupBy('no_prop')
                ->groupBy('no_kab')
                ->groupBy('no_kec')
                ->groupBy('no_kel')
                ->orderBy('no_kec')
                ->orderBy('no_kel')
                ->get();
        $data['tahun'] = listDKB()[$tbl];

        view()->share('items', $data);
//        if ($request->has('download')) {
//            $customPaper = array(0, 0, 609, 935);
//            $pdf = PDF::loadView('data.agregat.by_desa_cetak')->setPaper($customPaper, 'portrait')->setWarnings(false);
//
//            return $pdf->download('agregat_penduduk.pdf');
//        }
        return view('data.agregat.by_desa_jk_cetak', $data);
    }

    public function optionDistrik() {
        $d = Input::All();
        $display = "";
        $list = DB::table('setup_kec')
                ->select([DB::raw('*')])
//                ->join('prodis', 'konsentrasis.prodi_id', '=', 'prodis.id')
                ->where('no_prop', '=', $d['no_prop'])
                ->where('no_kab', '=', $d['no_kab'])
                ->orderBy('no_kec', 'asc')
                ->get();

        if ((!$list)) {
            $display .= "<option value=''>Belum ada data konsentrasi</option>";
        } else {
            $display .= "<option value='semua'>Semua</option>";

            foreach ($list as $data) {
                $display .= "<option value='" . $data->no_kec . "'>" . $data->no_kec . ' - ' . $data->nama_kec . "</option>";
            }
        }
        return $display;
    }

    public function optionKampung() {
        $d = Input::All();
        $display = "";
        if (Input::get('no_kec') == 'semua') {
            $display .= "<option value='semua'>Semua</option>";
        } else {
            $list = DB::table('setup_kel')
                    ->select([DB::raw('*')])
//                ->join('prodis', 'konsentrasis.prodi_id', '=', 'prodis.id')
                    ->where('no_prop', '=', $d['no_prop'])
                    ->where('no_kab', '=', $d['no_kab'])
                    ->where('no_kec', '=', $d['no_kec'])
                    ->orderBy('no_kel', 'asc')
                    ->get();

            if ((!$list)) {
                $display .= "<option value=''>Belum ada data konsentrasi</option>";
            } else {
                $display .= "<option value='semua'>Semua</option>";

                foreach ($list as $data) {
                    $display .= "<option value='" . $data->no_kel . "'>" . $data->no_kel . ' - ' . $data->nama_kel . "</option>";
                }
            }
        }

        return $display;
    }

//by_kecamatan
    public function agg_by_kecamatan() {
        $data['agregat'] = null;
        return view('data.agregat.by_kecamatan', $data);
    }

    public function post_by_kecamatan() {
//        return Input::all();

        $r = getSetupApp();
        $data['agregat'] = DB::table(Input::get('t_dkb'))
                ->select(DB::raw(" (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
getnamakec(no_kec,no_kab,no_prop) nama_kec,
count(decode(jenis_klmin,1,1))lk,
count(decode(jenis_klmin,2,1))pr,
count(*)jumlah_penduduk"))
                ->where('no_prop', '=', $r[0]->no_prop)
                ->where('no_kab', '=', $r[0]->no_kab)
                ->groupBy('no_prop')
                ->groupBy('no_kab')
                ->groupBy('no_kec')
                ->orderBy('no_kec')
                ->get();
        $data['tahun'] = listDKB()[Input::get('t_dkb')];
        $this->cetakxls_by_kecamatan(Input::get('t_dkb'), $data['agregat']);
        return view('data.agregat.by_kecamatan', $data);
    }

    public function cetakxls_by_kecamatan($dkb, $data) {

        $fff['tabel'] = $dkb;
        $fff['data'] = $data;
        Excel::create('jumlah_penduduk_tingkat_kecamatan', function($excel) use($fff) {


            $d['tabel'] = $fff['tabel'];
            $d['data'] = $fff['data'];
            $excel->sheet("Cek", function($sheet) use($d) {

                $row = 1;
                $no = 1;
                $sheet->cells('A1:F4', function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                });
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->mergeCells('A3:F3');
                $sheet->mergeCells('A4:F4');
                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row($row, array(
                    setDataInstansi()->instansi
                ));


                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    setDataInstansi()->opd
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    "JUMLAH PENDUDUK TINGKAT KECAMATAN "
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    " " . strtoupper(listDKB()[$d['tabel']])
                ));
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                ++$row;
                $rowawal = $row;
                $sheet->cells("A$row:F$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'No', 'Kode Kec', 'Nama Kec', 'Lk', 'Pr', 'Jumlah',
                ));



                $d['paket'] = $d['data'];
                $row_ht = $row;
                foreach ($d['paket'] as $dt) {
                    $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                    );
                    $sheet->row(++$row, array(
                                $no,
                                $dt->kdkec,
                                $dt->nama_kec,
                                $dt->lk,
                                $dt->pr,
                                ($dt->jumlah_penduduk),
                            ))
                            ->setHeight($row, 15);
                    $no++;
                }
                $row_ak = $row;
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                $sheet->mergeCells("A$row:E$row");
                $sheet->getStyle('F' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'right')
                );
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                $sheet->cells("A$row:F$row", function($cells) {
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'Jumlah', '', '', '', '', "=sum(F$row_ht:F$row_ak)",
                ));

                $sheet->setColumnFormat(array(
                    'F' => '0.00',
                ));
                $sheet->setBorder("A$rowawal:F$row", 'thin');
                $sheet->setAutoSize(true);
                $sheet->setWidth(array(
                    'A' => 8,
                    'B' => 10,
                    'C' => 30,
                    'D' => 15,
                    'E' => 30,
                    'F' => 10
                ));


                ++$row;
//                $sheet->getStyle("B$row:B$row")->getAlignment()->setWrapText(true);

                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->tempat_surat . ", " . date('d-m-Y')
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->pejabat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->opd
                        ))
                        ->setHeight($row, 15);
                ++$row;
                ++$row;
                ++$row;
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nama_ttd_surat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nip_surat
                        ))
                        ->setHeight($row, 15);
            });
        })->store('xlsx', public_path('files'), false);
//                ->download('xlsx');
    }

    //cetak cakupan akta lahir

    public function cetakxls_akta_lahir($dkb, $data) {

        $fff['tabel'] = $dkb;
        $fff['data'] = $data;
        Excel::create('jumlah_kepemilikan_akta_lahir', function($excel) use($fff) {
            $d['tabel'] = $fff['tabel'];
            $d['data'] = $fff['data'];
            $excel->sheet("Cek", function($sheet) use($d) {

                $row = 1;
                $no = 1;
                $sheet->cells('A1:H4', function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                });
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                $sheet->mergeCells('A3:H3');
                $sheet->mergeCells('A4:H4');
                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row($row, array(
                    setDataInstansi()->instansi
                ));
                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    setDataInstansi()->opd
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    "JUMLAH KEPEMILIKAN AKTA KELAHIRAN TINGKAT KAMPUNG"
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    " " . strtoupper(listDKB()[$d['tabel']])
                ));
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                ++$row;
                $rowawal = $row;
                $sheet->cells("A$row:H$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'No', 'Kode Kec', 'Nama Kec', 'Kode Kel', 'Nama Kel', 'LK', 'PR', 'Jumlah',
                ));



                $d['paket'] = $d['data'];
                $row_ht = $row;
                foreach ($d['paket'] as $dt) {
                    $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                    );
                    $sheet->row(++$row, array(
                                $no,
                                $dt->kdkec,
                                $dt->nama_kec,
                                $dt->kdkel,
                                $dt->namadesa_kel,
                                $dt->lk,
                                $dt->pr,
                                ($dt->jumlah_penduduk),
                            ))
                            ->setHeight($row, 15);
                    $no++;
                }
                $row_ak = $row;
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                $sheet->mergeCells("A$row:E$row");
                $sheet->getStyle('H' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'right')
                );
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                $sheet->cells("A$row:H$row", function($cells) {
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'Jumlah', '', '', '', '', "=sum(F$row_ht:F$row_ak)", "=sum(G$row_ht:G$row_ak)", "=sum(H$row_ht:H$row_ak)",
                ));

                $sheet->setColumnFormat(array(
                    'F' => '0.00',
                ));
                $sheet->setBorder("A$rowawal:H$row", 'thin');
                $sheet->setAutoSize(true);
                $sheet->setWidth(array(
                    'A' => 8,
                    'B' => 10,
                    'C' => 30,
                    'D' => 15,
                    'E' => 30,
                    'F' => 10
                ));


                ++$row;
//                $sheet->getStyle("B$row:B$row")->getAlignment()->setWrapText(true);

                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->tempat_surat . ", " . date('d-m-Y')
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->pejabat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->opd
                        ))
                        ->setHeight($row, 15);
                ++$row;
                ++$row;
                ++$row;
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nama_ttd_surat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nip_surat
                        ))
                        ->setHeight($row, 15);
            });
        })->store('xlsx', public_path('files'), false);
//                ->download('xlsx');
    }

    public function lahir_periodik() {
//        return Input::all();
        if (Input::get('no_kec') == 'semua' && Input::get('no_kel') == 'semua') {
            $pdo_cetak = DB::connection('oracle1')->getPdo();

            $r_cetak = $pdo_cetak->prepare("
          SELECT
    (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
getnamakec(no_kec,no_kab,no_prop) nama_kec,
(no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||trim(to_char(no_kec,'00'))||'.'||no_kel)kdkel,
getnamakel(no_kel,no_kec,no_kab,no_prop)namadesa_kel,
    sum (case when no_akta_lhr is not null and jenis_klmin=1 then 1 else 0 end)lk,
    sum (case when no_akta_lhr is not null and jenis_klmin=2 then 1 else 0 end)pr,
    sum (case when no_akta_lhr is not null then 1 else 0 end)jumlah_penduduk
    
FROM siakoff." . Input::get('t_dkb') . "
where no_prop=" . Input::get('no_prop') . " and no_kab=" . Input::get('no_kab') . "
GROUP BY no_prop,no_kab,no_kec, no_kel
ORDER BY no_kec, no_kel

          ");



            $r_cetak->execute();
            $data['capil_lahir'] = $r_cetak->fetchAll((\PDO::FETCH_OBJ));
            $data['tahun'] = listDKB()[Input::get('t_dkb')];
            $data['nama_kec'] = null;
            $data['nama_kel'] = null;
            $this->cetakxls_akta_lahir(Input::get('t_dkb'), $data['capil_lahir']);
            return view('data.capil.akta_lahir', $data);
        } else if (Input::get('no_kec') != 'semua' && Input::get('no_kel') == 'semua') {
            $pdo_cetak = DB::connection('oracle1')->getPdo();

            $r_cetak = $pdo_cetak->prepare("
          SELECT
    (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
getnamakec(no_kec,no_kab,no_prop) nama_kec,
(no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||trim(to_char(no_kec,'00'))||'.'||no_kel)kdkel,
getnamakel(no_kel,no_kec,no_kab,no_prop)namadesa_kel,
    sum (case when no_akta_lhr is not null and jenis_klmin=1 then 1 else 0 end)lk,
    sum (case when no_akta_lhr is not null and jenis_klmin=2 then 1 else 0 end)pr,
    sum (case when no_akta_lhr is not null then 1 else 0 end)jumlah_penduduk
    
FROM siakoff." . Input::get('t_dkb') . "
where no_prop=" . Input::get('no_prop') . " and no_kab=" . Input::get('no_kab') . "
    and no_kec=" . Input::get('no_kec') . "
GROUP BY no_prop,no_kab,no_kec, no_kel
ORDER BY no_kec, no_kel
          ");



            $r_cetak->execute();
            $data['capil_lahir'] = $r_cetak->fetchAll((\PDO::FETCH_OBJ));
            $data['tahun'] = listDKB()[Input::get('t_dkb')];
            $data['nama_kec'] = getDistrik(Input::get('no_kec'));
            $data['nama_kel'] = null;
            return view('data.capil.akta_lahir', $data);
        } else if (Input::get('no_kec') != 'semua' && Input::get('no_kel') != 'semua') {
            $pdo_cetak = DB::connection('oracle1')->getPdo();

            $r_cetak = $pdo_cetak->prepare("
          SELECT
    (no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||(trim(to_char(no_kec,'00'))))kdkec,
getnamakec(no_kec,no_kab,no_prop) nama_kec,
(no_prop||'.'||(trim(to_char(no_kab,'00')))||'.'||trim(to_char(no_kec,'00'))||'.'||no_kel)kdkel,
getnamakel(no_kel,no_kec,no_kab,no_prop)namadesa_kel,
    sum (case when no_akta_lhr is not null and jenis_klmin=1 then 1 else 0 end)lk,
    sum (case when no_akta_lhr is not null and jenis_klmin=2 then 1 else 0 end)pr,
    sum (case when no_akta_lhr is not null then 1 else 0 end)jumlah_penduduk
    
FROM siakoff." . Input::get('t_dkb') . "
where no_prop=" . Input::get('no_prop') . " and no_kab=" . Input::get('no_kab') . "
    and no_kec=" . Input::get('no_kec') . "  and no_kel=" . Input::get('no_kel') . "
GROUP BY no_prop,no_kab,no_kec, no_kel
ORDER BY no_kec, no_kel
          ");



            $r_cetak->execute();
            $data['capil_lahir'] = $r_cetak->fetchAll((\PDO::FETCH_OBJ));
            $data['tahun'] = listDKB()[Input::get('t_dkb')];
            $data['nama_kec'] = getDistrik(Input::get('no_kec'));
            $data['nama_kel'] = getKampung(Input::get('no_kec'), Input::get('no_kel'));
            return view('data.capil.akta_lahir', $data);
        }
    }

    public function capil_lahir() {
        $data['capil_lahir'] = null;
        return view('data.capil.akta_lahir', $data);
    }

    public function rekap_lahir() {
        $data['rekap_lahir'] = null;
        return view('data.capil.rekap', $data);
    }

    public function postrekap_lahir() {
        $tabel_capil = Input::get('tabel_capil');
        switch ($tabel_capil) {
            case 'capil_lahir':
                $data['kop'] = 'Kelahiran';

                break;
            case 'capil_kawin':
                $data['kop'] = 'Perkawinan';

                break;
            case 'capil_cerai':
                $data['kop'] = 'Perceraian';

                break;
            case 'capil_mati':
                $data['kop'] = 'Kematian';

                break;
            default:
                break;
        }
        $pdo_cetak = DB::connection('oracle1')->getPdo();

        $r_cetak = $pdo_cetak->prepare("
          select 
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=1 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) januari,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=2 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) februari,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=3 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) maret,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=4 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) april,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=5 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) mei,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=6 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) juni,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=7 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) juli,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=8 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) agustus,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=9 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) september,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=10 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) oktober,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=11 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) nopember,
          COUNT(CASE WHEN EXTRACT(month FROM adm_akta_tgl)=12 and EXTRACT(year FROM adm_akta_tgl)=" . Input::get('tahun') . " THEN 1 ELSE NULL END) desember
          from " . $tabel_capil . "

          ");



        $r_cetak->execute();
        $data['rekap_lahir'] = $r_cetak->fetchAll((\PDO::FETCH_OBJ));
        $data['tahun'] = Input::get('tahun');
        $this->cetakxls_rekap_akta_lahir($data['rekap_lahir']);
        return view('data.capil.rekap', $data);
    }

    public function cetakxls_rekap_akta_lahir($data) {

        $fff['data'] = $data;
        Excel::create('rekap_pelayanan_akta_kelahiran', function($excel) use($fff) {
            $d['data'] = $fff['data'];
            $excel->sheet("Cek", function($sheet) use($d) {

                $row = 1;
                $no = 1;
                $sheet->cells('A1:M4', function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                });
                $sheet->mergeCells('A1:M1');
                $sheet->mergeCells('A2:M2');
                $sheet->mergeCells('A3:M3');
                $sheet->mergeCells('A4:M4');
                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row($row, array(
                    setDataInstansi()->instansi
                ));
                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    setDataInstansi()->opd
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    "REKAPITULASI PENERBITAN AKTA KELAHIRAN"
                ));

                $sheet->cells("A$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '12',
                        'bold' => true
                    ));
                })->row( ++$row, array(
                    " "
                ));
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;
                ++$row;
                $rowawal = $row;
                $sheet->cells("A$row:M$row", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFont(array(
                        'family' => 'Calibri',
                        'size' => '11',
                        'bold' => true
                    ));
                })->row($row, array(
                    'No', 'Januari',
                    'Februari', 'Maret',
                    'April', 'Mei', 'Juni',
                    'Juli', 'Agustus',
                    'September', 'Oktober',
                    'Nopember', 'Desember'
                ));



                $d['paket'] = $d['data'];
                $row_ht = $row;
                foreach ($d['paket'] as $dt) {
                    $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                    );
                    $sheet->row(++$row, array(
                                $no,
                                $dt->januari,
                                $dt->februari,
                                $dt->maret,
                                $dt->april,
                                $dt->mei,
                                $dt->juni,
                                $dt->juli,
                                $dt->agustus,
                                $dt->september,
                                $dt->oktober,
                                $dt->nopember,
                                $dt->desember,
                            ))
                            ->setHeight($row, 15);
                    $no++;
                }
                $row_ak = $row;
                $sheet->getStyle('A' . $row)->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                );
                ++$row;


                $sheet->setColumnFormat(array(
                    'F' => '0.00',
                ));
                $sheet->setBorder("A$rowawal:M$row", 'thin');
                $sheet->setAutoSize(true);
                $sheet->setWidth(array(
                    'A' => 12,
                    'B' => 12,
                    'C' => 12,
                    'D' => 12,
                    'E' => 12,
                    'F' => 12,
                    'G' => 12,
                    'H' => 12,
                    'I' => 12,
                    'J' => 12,
                    'K' => 12,
                    'L' => 12,
                    'M' => 12,
                ));


                ++$row;
//                $sheet->getStyle("B$row:B$row")->getAlignment()->setWrapText(true);

                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->tempat_surat . ", " . date('d-m-Y')
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->pejabat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->opd
                        ))
                        ->setHeight($row, 15);
                ++$row;
                ++$row;
                ++$row;
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nama_ttd_surat
                        ))
                        ->setHeight($row, 15);
                $sheet->row( ++$row, array(
                            '', '', '', '', setDataInstansi()->nip_surat
                        ))
                        ->setHeight($row, 15);
            });
        })->store('xlsx', public_path('files'), false);
//                ->download('xlsx');
    }

    //pmapper
    public function indexdistrik($kode) {
//        return $kode;
        $no_prop = substr($kode, 0, 2);
        $no_kab = substr($kode, 3, 2);
        $no_kec = substr($kode, -2);
        $no_prop . $no_kab . $no_kec;
        $data['nama_kec'] = '';
        return view('webgis.indexdistrik', $data);
    }

    public function indexpeta() {
        return '<iframe src="http://36.91.28.194:818/pmapper/map_default.phtml?config=jyw1"height="800" width="100%"></iframe>';   
    }

}
