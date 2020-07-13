<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kategorisurat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use App\DataWni;
use Illuminate\Support\Facades\Input;
use App\Demographic;
use Illuminate\Support\Facades\DB;
use App\Updatedwhs;
use App\Jenislayanan;
use Illuminate\Support\Facades\Auth;
use App\Pengajuan;
use App\Dokumenlayanan;
use App\Dokumenupload;
use App\Formisian;
use App\Formulirlayanan;
use App\Mekanismelayanan;
use App\Soplayanan;
use App\Syaratlayanan;
use App\Setupaplikasi;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Dompdf\Dompdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->middleware('auth:');
    }

    public function index() {
//        return 1;
        $data['data_pengajuan'] = Pengajuan::select([DB::raw(' 
              pengajuans.id, nomor_pengajuan, tanggal_pengajuan, nama_pengajuan, nama_layanan, deskripsi, link_gambar     ')])
                ->where('user_id', '=', Auth::guard('web')->user()->id)
                ->join('jenislayanans', 'pengajuans.jenislayanan_id', '=', 'jenislayanans.id')
                ->join('statuspengajuans', 'pengajuans.status_pengajuan', '=', 'statuspengajuans.kode_status')
                ->get();

        return view('user.index', $data);
    }

    public function indexinformasi() {
        $data['informasi'] = \App\Information::where('user_id', '=', Auth::guard('web')->user()->id)->get();
        return view('user.informasi', $data);
    }

    public function indexpengajuan($id) {
        if (Auth::guard('web')->user()->status_user == 0 || Auth::guard('web')->user()->status_user == 2) {
            return redirect('/user');
        } else {
            $data['pelayanan'] = Jenislayanan::findOrFail($id);
            $data['persyaratan'] = Jenislayanan::find($id)->persyaratan;
            $data['mekanisme'] = Jenislayanan::find($id)->mekanisme;
            $data['formisian'] = Jenislayanan::find($id)->formisian;
            $data['dokumenupload'] = Jenislayanan::find($id)->dokumenupload;
            $data['statuspengajuan'] = \App\Statuspengajuan::orderBy('id')->get();
            $data['soplayanan'] = Jenislayanan::find($id)->soplayanan;
            $data['dokumenlayanan'] = Jenislayanan::find($id)->dokumenlayanan;
            return view('layanan.pengajuan', $data);
        }
    }

    public function postpengajuan(Request $request) {
//        return Input::all();
        for ($i = 0; $i < count(Input::get('form_upload')); $i++) {
            $ext = Input::file('data_upload')[$i]->getClientOriginalExtension();
            if ($ext == 'JPG' || $ext == 'jpg' || $ext == 'png') {
                $file[] = Input::get('user_id') . "_" . Input::get('jenispelayanan_id') . "_" . date('Ymd') . '_' . clean(Input::get('form_upload')[$i]) . '_' . str_replace(" ", "_", Input::file('data_upload')[$i]->getClientOriginalName());

                $dt[] = [
                    Input::get('form_upload')[$i] => "/files/pengajuan/upload/" . $file[$i]
                ];
                Input::file('data_upload')[$i]->move(public_path('/files/pengajuan/upload/'), $file[$i]);
            } else {
                return redirect('layanan/' . Input::get('jenispelayanan_id') . '/pengajuan')->with('status', 'FILE HARUS BERTYPE GAMBAR');
            }
        }

        for ($i = 0; $i < count(Input::get('form_isian')); $i++) {
            $d[] = [
                Input::get('form_isian')[$i] => Input::get('data_isian')[$i]
            ];
        }
        $data_isian = json_encode($d);



        $data_upload = json_encode($dt);
        //buat nomor pengajuan
        $stp = Setupaplikasi::findOrFail(1);

        $dd = 0;
        $urut = 1;
        $prefix = '';
        $date = date('Y-m-d');
        $date_1 = date('Y-m-d', strtotime($date . '+ 1 days'));
        $dd = Pengajuan::whereBetween('tanggal_pengajuan', [$date, $date_1])
                ->count();
        if ($dd == 0) {
            $urut = 1;
        } else {
            $urut = $dd++;
        }
        if ($urut < 10) {
            $prefix = '00';
        } else if ($urut > 10 && $urut < 100) {
            $prefix = '0';
        } else {
            $prefix = '';
        }
        $nomor = $stp->no_prop . $stp->no_kab . '/PB/' . date('dmY') . '/' . $prefix . ($urut);

        $data = [
            'user_id' => Input::get('user_id'),
            'jenislayanan_id' => Input::get('jenispelayanan_id'),
            'catatan' => 'Pemohon melakukan pengajuan layanan',
            'data_isian' => ($data_isian),
            'data_upload' => ($data_upload),
            'nomor_pengajuan' => $nomor
        ];
//        return $data;
        $pengajuan = \App\Pengajuan::create($data);
        $id = $pengajuan->id;
        Logpengajuan($id, '1', 'Pemohon melakukan pengajuan layanan', Auth::guard('web')->user()->email);

        return redirect('/user');
    }

    public function detailpengajuan($pengajuan_id) {

        $data['pengajuan'] = Pengajuan::findOrFail($pengajuan_id);
        $data['riwayat'] = \App\Historypengajuan::where('pengajuan_id', '=', $pengajuan_id)->get();
        $data['proses'] = \App\Riwayatprose::where('pengajuan_id', '=', $pengajuan_id)->get();
        $data['ambildok'] = \App\Ambildok::where('pengajuan_id', '=', $pengajuan_id)->get();
        $data['uploaddok'] = \App\Uploaddok::where('pengajuan_id', '=', $pengajuan_id)->get();
        $data['pelayanan'] = Jenislayanan::findOrFail($data['pengajuan']->jenislayanan_id);
        $data['dokumenlayanan'] = Jenislayanan::find($data['pengajuan']->jenislayanan_id)->dokumenlayanan;
        $data['dokumenupload'] = Jenislayanan::find($data['pengajuan']->jenislayanan_id)->dokumenupload;


        return view('layanan.detailpengajuan', $data);
    }

    function cetakdetailpengajuan($id, Request $request) {
//        return Crypt::decrypt($id);
        $data['pengajuan'] = Pengajuan::select([DB::raw(' 
                pengajuans.id,pengajuans.jenislayanan_id,jenislayanans.link_gambar,jenislayanans.nama_layanan,
                pengajuans.tanggal_pengajuan,statuspengajuans.nama_pengajuan,pengajuans.nomor_pengajuan,
                pengajuans.data_isian, pengajuans.data_upload,users.name, users.email, users.no_hp, users.no_kk,
                users.alamat, users.created_at
             
                ')])
                ->where('pengajuans.id', '=', Crypt::decrypt($id))
                ->join('jenislayanans', 'pengajuans.jenislayanan_id', '=', 'jenislayanans.id')
                ->join('statuspengajuans', 'pengajuans.status_pengajuan', '=', 'statuspengajuans.kode_status')
                ->join('users', 'pengajuans.user_id', '=', 'users.id')
                ->first();

//       return $data['pengajuan'] = Pengajuan::findOrFail(Crypt::decrypt($id));
        $data['riwayat'] = \App\Historypengajuan::where('pengajuan_id', '=', Crypt::decrypt($id))->get();
        $data['pelayanan'] = Jenislayanan::findOrFail($data['pengajuan']->jenislayanan_id);
        $data['persyaratan'] = Jenislayanan::findOrFail($data['pengajuan']->jenislayanan_id)->persyaratan;
        $data['statusproses'] = Jenislayanan::findOrFail($data['pengajuan']->jenislayanan_id)->soplayanan;
        $data['dokumenlayanan'] = Jenislayanan::find($data['pengajuan']->jenislayanan_id)->dokumenlayanan;
        $data['dokumenupload'] = Jenislayanan::find($data['pengajuan']->jenislayanan_id)->dokumenupload;
        $data['statuspengajuan'] = \App\Statuspengajuan::orderBy('id')->get();

        $data_page['items'] = $data;
//        return view('backEnd.pengajuan.cetak_pengajuan', $data_page);
        view()->share('items', $data);
//        $customPaper = array(0, 0, 609, 935);
        $pdf = PDF::loadView('backEnd.pengajuan.cetak_pengajuan')->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download('Rincian Pengajuan Layanan Adminduk.pdf');
    }

    public function cetaklabel() {
        return view('label');
    }

    function cetaklabelalamat($id, Request $request) {
//        return Crypt::decrypt($id);
        $data['pengajuan'] = Pengajuan::select([DB::raw(' 
                pengajuans.id,pengajuans.jenislayanan_id,jenislayanans.link_gambar,jenislayanans.nama_layanan,
                pengajuans.tanggal_pengajuan,statuspengajuans.nama_pengajuan,pengajuans.nomor_pengajuan,
                pengajuans.data_isian, pengajuans.data_upload,users.name, users.email, users.no_hp, users.no_kk,
                users.alamat, users.created_at
             
                ')])
                ->where('pengajuans.id', '=', Crypt::decrypt($id))
                ->join('jenislayanans', 'pengajuans.jenislayanan_id', '=', 'jenislayanans.id')
                ->join('statuspengajuans', 'pengajuans.status_pengajuan', '=', 'statuspengajuans.kode_status')
                ->join('users', 'pengajuans.user_id', '=', 'users.id')
                ->first();

//       return $data['pengajuan'] = Pengajuan::findOrFail(Crypt::decrypt($id));
        $data['persyaratan'] = Jenislayanan::findOrFail($data['pengajuan']->jenislayanan_id)->persyaratan;

        $data_page['items'] = $data;
        return view('user.label', $data);
    }

}
