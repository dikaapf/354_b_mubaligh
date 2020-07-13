<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Jenislayanan;
use PDF;
use Dompdf\Dompdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller {

    public function __construct() {
//        $this->middleware('auth:operator');
        $this->middleware('auth:operator', [
            'except' => [
                'cetakpetunjuk',
//                'create',
//                'store',
//                'show',
//                'edit',
//                'update',
//                'destroy',
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {


//        $pengajuan = Pengajuan::all();
        $data['pengajuan'] = Pengajuan::select([DB::raw(' 
                pengajuans.id,pengajuans.jenislayanan_id,jenislayanans.nama_layanan,
                statuspengajuans.nama_pengajuan, pengajuans.proses_terakhir,pengajuans.tanggal_pengajuan,
                users.email, users.name, pengajuans.status_pengajuan,pengajuans.process_by
                

')])
//                ->where('user_id', '=', Auth::guard('web')->user()->id)
                ->join('jenislayanans', 'pengajuans.jenislayanan_id', '=', 'jenislayanans.id')
                ->join('statuspengajuans', 'pengajuans.status_pengajuan', '=', 'statuspengajuans.kode_status')
                ->join('users', 'pengajuans.user_id', '=', 'users.id')
                ->get();

        return view('backEnd.pengajuan.index', $data);
    }

    public function updateproses($id, Request $request) {
//        return Input::all();
        $this->validate($request, [
            'diproses_oleh' => 'required',
            'catatan' => 'required',
        ]);

//        $operator = Auth::guard('operator')->user()->name;

        $p = Pengajuan::findOrFail(Crypt::decrypt($id));
        $p->update([
            'proses_terakhir' => Input::get('nama_proses'),
            'processed_by_operator' => Input::get('diproses_oleh')
        ]);
        LogProses(Crypt::decrypt($id), Input::get('nama_proses'), Input::get('catatan'), Input::get('diproses_oleh'));
        if (Input::get('status_pengajuan') <= 2) {
            $p->update([
                'status_pengajuan' => 3,
                'process_by' => Auth::guard('operator')->user()->email
            ]);
            Logpengajuan(Crypt::decrypt($id), Input::get('status_pengajuan'), 'Pengajuan sedang dalam proses pengerjaan', Input::get('diproses_oleh'));
        }


        return redirect('daftar-pengajuan/' . ($id) . '/detail')->with('status', 'Pengajuan berhasil di update');
    }

    public function updatestatus($id) {

//        return $operator = Auth::guard('operator')->user()->email;
//        return Input::all();
        if (Input::get('status_pengajuan') != null) {
            $p = Pengajuan::findOrFail(Crypt::decrypt($id));
            $p->update([
                'status_pengajuan' => Input::get('status_pengajuan'),
                'catatan' => Input::get('catatan'),
                'process_by' => Auth::guard('operator')->user()->email
            ]);
            if (Input::get('nama_proses') != null) {
                echo Input::get('nama_proses');
                $p->update([
                    'proses_terakhir' => Input::get('nama_proses'),
                    'processed_by_operator' => Input::get('diproses_oleh')
                ]);
                LogProses(Crypt::decrypt($id), Input::get('nama_proses'), Input::get('catatan'), Input::get('diproses_oleh'));
            }
            Logpengajuan(Crypt::decrypt($id), Input::get('status_pengajuan'), Input::get('catatan'), Auth::guard('operator')->user()->email);
            return redirect('daftar-pengajuan/' . ($id) . '/detail')->with('status', 'Pengajuan berhasil di update');
        } else {
            return redirect('daftar-pengajuan/' . ($id) . '/detail')->with('status', 'Pengajuan telah selesai');
        }
    }

    public function ambildok($id) {

//        $operator = Auth::guard('operator')->user()->name;
//        return Input::all();

        \App\Ambildok::create([
            'pengajuan_id' => Crypt::decrypt($id),
            'tanggal_ambil' => Input::get('tanggal_ambil'),
            'ambil_oleh' => Input::get('ambil_oleh'),
            'jenis_dok' => Input::get('jenis_dokumen'),
            'catatan' => Input::get('catatan')
        ]);
        return redirect('daftar-pengajuan/' . ($id) . '/detail')->with('status', 'Status Pengambilan berhasil di update');
    }

    public function detailpengajuan($id) {
        $cekoperator = false;
        $getOperator = null;
        $operator = Auth::guard('operator')->user()->email;

        $getOperator = Pengajuan::select([DB::raw('process_by')])
                ->where('pengajuans.id', '=', Crypt::decrypt($id))
                ->first();
//        foreach ($getOperator as $opr) {
//        $operator = $operator != $opr->process_by ? true : false;
//        }

        if ($operator == $getOperator->process_by) {
//            die('sama');
            $data['pengajuan'] = Pengajuan::select([DB::raw(' 
           pengajuans.id,jenislayanan_id,link_gambar,nama_layanan,
                tanggal_pengajuan,nama_pengajuan,nomor_pengajuan,
                data_isian, data_upload,name, email, no_hp, no_kk,
                alamat, users.created_at, status_pengajuan
             
                ')])
                    ->where('pengajuans.id', '=', Crypt::decrypt($id))
                    ->join('jenislayanans', 'pengajuans.jenislayanan_id', '=', 'jenislayanans.id')
                    ->join('statuspengajuans', 'pengajuans.status_pengajuan', '=', 'statuspengajuans.kode_status')
                    ->join('users', 'pengajuans.user_id', '=', 'users.id')
                    ->first();
            $data['pengajuan_id'] = Crypt::decrypt($id);
//       return $data['pengajuan'] = Pengajuan::findOrFail(Crypt::decrypt($id));
            $data['riwayat'] = \App\Historypengajuan::where('pengajuan_id', '=', Crypt::decrypt($id))->get();
            $data['proses'] = \App\Riwayatprose::where('pengajuan_id', '=', Crypt::decrypt($id))->get();
            $data['ambildok'] = \App\Ambildok::where('pengajuan_id', '=', Crypt::decrypt($id))->get();
            $data['uploaddok'] = \App\Uploaddok::where('pengajuan_id', '=', Crypt::decrypt($id))->get();
            $data['pelayanan'] = Jenislayanan::findOrFail($data['pengajuan']->jenislayanan_id);
            $data['dokumenlayanan'] = Jenislayanan::find($data['pengajuan']->jenislayanan_id)->dokumenlayanan;
            $data['dokumenupload'] = Jenislayanan::find($data['pengajuan']->jenislayanan_id)->dokumenupload;


            return view('backEnd.pengajuan.show', $data);
        } else {
//            die('tidak sama');
            return redirect('daftar-pengajuan')->with('status', 'Pengajuan telah di proses oleh petugas lain');
        }

//        return Crypt::decrypt($id);
    }

    public function uploaddok($id) {
//        return Crypt::decrypt($id);
//        return Input::all();
        if (Input::hasfile('link_file')) {
            $file = "dokumenupload_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_file')->getClientOriginalName());
            $ext = Input::file('link_file')->getClientOriginalExtension();
            if ($ext == 'pdf') {
                Input::file('link_file')->move(public_path('/files/layanan'), $file);
                \App\Uploaddok::create([
                    'pengajuan_id' => Crypt::decrypt($id),
                    'link_file' => "/files/layanan/$file",
                    'deskripsi_upload' => Input::get('deskripsi_upload'),
                    'uploaded_by' => Auth::guard('operator')->user()->email,
                ]);
                return redirect('daftar-pengajuan/' . ($id) . '/detail')->with('status', 'Upload dokumen berhasil');
            } else {
                return redirect('daftar-pengajuan/' . ($id) . '/detail')->with('status', 'File harus berupa PDF');
            }
        } else {
            return redirect('daftar-pengajuan/' . ($id) . '/detail')->with('status', 'File tidak ditemukan');
        }
    }

    public function cetakpetunjuk($id, Request $request) {
//         Crypt::decrypt($id);
        $data['pelayanan'] = Jenislayanan::findOrFail(Crypt::decrypt($id));
        $data['persyaratan'] = Jenislayanan::find(Crypt::decrypt($id))->persyaratan;
        $data['mekanisme'] = Jenislayanan::find(Crypt::decrypt($id))->mekanisme;
        $data['formisian'] = Jenislayanan::find(Crypt::decrypt($id))->formisian;
        $data['formulir'] = Jenislayanan::find(Crypt::decrypt($id))->formulir;
        $data['dokumenupload'] = Jenislayanan::find(Crypt::decrypt($id))->dokumenupload;
        $data['statuspengajuan'] = \App\Statuspengajuan::orderBy('id')->get();
        $data['soplayanan'] = Jenislayanan::find(Crypt::decrypt($id))->soplayanan;
        $data['dokumenlayanan'] = Jenislayanan::find(Crypt::decrypt($id))->dokumenlayanan;

        $data_page['items'] = $data;
//        return view('backEnd.pengajuan.cetak_petunjuk', $data_page);
        view()->share('items', $data);
//        $customPaper = array(0, 0, 609, 935);
        $pdf = PDF::loadView('backEnd.pengajuan.cetak_petunjuk')->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download($data['pelayanan']->nama_layanan . '.pdf');
    }

    public function cetakdetailpengajuan($id, Request $request) {
//        return Crypt::decrypt($id);
        $data['pengajuan'] = Pengajuan::select([DB::raw(' 
               *
             
                ')])
                ->where('pengajuans.id', '=', Crypt::decrypt($id))
//                ->join('jenislayanans', 'pengajuans.jenislayanan_id', '=', 'jenislayanans.id')
//                ->join('statuspengajuans', 'pengajuans.status_pengajuan', '=', 'statuspengajuans.kode_status')
//                ->join('users', 'pengajuans.user_id', '=', 'users.id')
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

    public function printdetailpengajuan($id, Request $request) {
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
        return view('backEnd.pengajuan.cetak_pengajuan', $data_page);
//        view()->share('items', $data);
//        $customPaper = array(0, 0, 609, 935);
//        $pdf = PDF::loadView('backEnd.pengajuan.cetak_pengajuan')->setPaper('a4', 'portrait')->setWarnings(false);
//        return $pdf->download('Rincian Pengajuan Layanan Adminduk.pdf');
    }

}
