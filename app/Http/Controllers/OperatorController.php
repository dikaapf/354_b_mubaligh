<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Operator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use App\Outbox;
use App\Inboxtable;
use App\Information;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller {

    public function __construct() {
        $this->middleware('auth:pengajar');
//        $this->middleware('auth:pengajar', [
//            'except' => [
//                'indexpengajar',
//                'create',
//                'store',
//                'show',
//                'edit',
//                'update',
//                'destroy',
//        ]]);
    }

    public function index() {
//        return 0;
        return view('pengajar.home');
    }

    public function indexpengajar() {
        $pengajar = Operator::all();

        return view('backEnd.pengajar.index', compact('pengajar'));
    }

    public function create() {
        $data['list_opd'] = $this->listOpd();
        return view('backEnd.pengajar.create', $data);
    }

    public function store(Request $request) {
        return Input::all();
        $this->validate($request, ['password' => 'required',]);
        $data = array(
            'nama' => Input::get('nama'),
            'nip' => bersihkan(Input::get('nip')),
            'password' => bcrypt(Input::get('password')),
            'pengajar_level' => Input::get('pengajar_level'),
            'opd_id' => Input::get('opd_id'),
        );
        Operator::create($data);

        Session::flash('message', 'Operator added!');
        Session::flash('status', 'success');

        return redirect('pengajaropd');
    }

    public function show($id) {
        $pengajar = Operator::findOrFail($id);

        return view('backEnd.pengajar.show', compact('pengajar'));
    }

    public function edit($id) {
        $data['list_opd'] = $this->listOpd();
        $data['pengajar'] = Operator::findOrFail($id);

        return view('backEnd.pengajar.edit', $data);
    }

    public function update($id, Request $request) {
//        $this->validate($request, ['password' => 'required',]);

        $pengajar = Operator::findOrFail($id);
        $pengajar->update($request->all());

        Session::flash('message', 'Operator updated!');
        Session::flash('status', 'success');

        return redirect('pengajaropd');
    }

    public function destroy($id) {
        $pengajar = Operator::find($id);

        $pengajar->delete();

        Session::flash('message', 'Operator deleted!');
        Session::flash('status', 'success');

        return redirect('pengajaropd');
    }

    public function indexuserlist() {
        $data['user_list'] = User::All();
        return view('pengajar.indexuserlist', $data);
    }

    public function adduser() {
        return view('pengajar.adduser');
    }

    public function verifyuser($id) {
//        return Crypt::decrypt($id);

        $r = User::FindOrFail(Crypt::decrypt($id));
        $r->update([
            'status_user' => 1
        ]);
        return redirect('pengguna')->with('status', 'Verifikasi Berhasil');
    }

    public function pendingyuser($id) {
//        return Crypt::decrypt($id);

        $r = User::FindOrFail(Crypt::decrypt($id));
        $r->update([
            'status_user' => 2
        ]);
        return redirect('pengguna')->with('status', 'Pending Berhasil');
    }

    public function batalverifyuser($id) {
//        return Crypt::decrypt($id);

        $r = User::FindOrFail(Crypt::decrypt($id));
        $r->update([
            'status_user' => 0
        ]);
        return redirect('pengguna')->with('status', 'Verifikasi Berhasil Dibatalkan');
    }

    public function showuser($id) {
        $data['user'] = User::findOrFail(Crypt::decrypt($id));

        return view('pengajar.showuser', $data);
    }

    public function deluser($id) {
        $pengajar = User::find(Crypt::decrypt($id));
        $pengajar->delete();
        return redirect('/pengguna');
    }

    public function verifikasiuser() {
//        return Input::all();
//       return Outbox::all();

        $data = array(
            'textdecoded' => "Sdr." . Input::get('nama') . ", Akun anda telah aktif pada layanan online Disdukcapil Jayawijaya. Silahkan ajukan layanan yang diinginkan. Jenis Layanan akan di tambahkan secara bertahap",
            'destinationnumber' => Input::get('no_hp'),
        );
        Outbox::create($data);
        return 1;
    }

    public function inbox() {
        $data['sms_masuk'] = Inboxtable::orderBy('id', 'desc')->get();
        return view('pengajar.inbox', $data);
    }

    public function sentitem() {
        $data['sms_keluar'] = \App\Sentitem::orderBy('id', 'desc')->get();
        return view('pengajar.sentitem', $data);
    }

    public function kirimpesan() {
//        return Input::all();

        $pengajar = Auth::guard('pengajar')->user()->email;

        switch (Input::get('smsoption')) {
            case 1:
                $pesan_sms = 'Maaf akun registrasi anda pada layanan Adminduk Online Disdukcapil Jayawijaya tidak dapat diverifikasi. '
                        . 'Silahkan melihat informasi pada akun anda.';

                $pesan_pengguna = "Saat ini akun anda dalam status <b>PENDING</b> dan belum dapat diverifikasi oleh petugas dikarenakan beberapa"
                        . "hal sebagai berikut: <br>";
                $pesan_pengguna.="<ol>";
                $n = 1;
                foreach (Input::get('alasan') as $key => $value) {
                    $pesan_pengguna .= "$n. " . $value . "<br>";
                }
                $n++;
                $pesan_pengguna.="</ol>";
                $pesan_pengguna.= "Yang harus anda lakukan adalah:<br>";
                $pesan_pengguna.="<ol>";
                $ss = 1;
                foreach (Input::get('solusi') as $key => $value) {
                    $pesan_pengguna .= "$ss. " . $value . "<br>";
                }
                $ss++;
                $pesan_pengguna.="</ol>";
                $pesan_pengguna.="Informasi lebih lanjut silahkan menghubungi nomor WA : 0822-4815-3687";
                $data = [
                    'user_id' => Input::get('user_id'),
                    'created_user' => $pengajar,
                    'isi_pesan' => $pesan_pengguna,
                ];
                Information::create($data);
                $data = array(
                    'textdecoded' => $pesan_sms,
                    'destinationnumber' => Input::get('destinationnumber'),
                );
                Outbox::create($data);
                return 1;
                break;

            default:
                break;
        }
    }

    public function balaspesan() {
        $data = array(
            'textdecoded' => Input::get('textdecoded'),
            'destinationnumber' => Input::get('destinationnumber'),
        );
        Outbox::create($data);
        return 1;
    }

}
