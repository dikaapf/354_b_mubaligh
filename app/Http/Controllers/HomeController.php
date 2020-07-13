<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Jenislayanan;
use App\Operator;
use App\Pengajuan;
use App\Dokumenlayanan;
use App\Dokumenupload;
use App\Formisian;
use App\Formulirlayanan;
use App\Mekanismelayanan;
use App\Soplayanan;
use App\Syaratlayanan;
use Illuminate\Support\Facades\Crypt;
use App\Bantuan;
use App\Setupaplikasi;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin', [
            'except' => [
                'indexpublic',
                'indexinfo',
                'detaillayanan',
                'bantuan',
                'downloadpetunjuk',
                'downloadformulir',
                'detailinfo',
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('admin.home');
    }

    public function indexpublic() {
        return view('welcome'); 
    }

    public function indexinfo() {
        $data['instansi'] = Setupaplikasi::findOrFail(1);
//        $data['pertanyaan'] = Bantuan::where('status', '=', 1)->get();
        $data['pengumuman'] = \App\Pengumuman::orderBy('created_at', 'desc')->take(1)->get();
        $data['pengumuman_list'] = \App\Pengumuman::orderBy('created_at', 'desc')->get();

        return view('info', $data);
    }

    public function detailinfo($id) {
        $data['instansi'] = Setupaplikasi::findOrFail(1);
        $data['pengumuman_list'] = \App\Pengumuman::orderBy('created_at', 'desc')->get();
        $data['pengumuman'] = \App\Pengumuman::where('id', '=', Crypt::decrypt($id))->take(1)->get();

        return view('detailinfo', $data);
    }

    public function indexuserlist() {
        $data['user_list'] = User::All();
        return view('user.indexuserlist', $data);
    }

    public function adduser() {
        return view('user.adduser');
    }

    public function postadduser(Request $request) {
//        return Input::all();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'instansi' => 'required',
        ]);
        $data = [
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'nip' => Input::get('nip'),
            'nik' => Input::get('nik'),
            'instansi' => Input::get('instansi'),
            'unit_kerja' => Input::get('unit_kerja'),
            'status_user' => Input::get('status_user'),
        ];
        User::create($data);

        Session::flash('message', 'Pengguna added!');
        Session::flash('status', 'success');

        return redirect('user/add')->with('status', 'Tambah pengguna sukses');
    }

    public function addoperator() {
        return view('operator.addoperator');
    }

    public function editoperator($id) {
        $data['operator'] = Operator::findOrFail(Crypt::decrypt($id));
        return view('user.editoperator', $data);
    }

    public function updateoperator($id) {
//        return Input::all();
        $r = Operator::findOrFail(Crypt::decrypt($id));

        if (Input::get('password') != null) {
            $r->update([
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'status_operator' => Input::get('status_operator'),
                'no_hp' => Input::get('no_hp'),
                'alamat' => Input::get('alamat'),
                'unit_kerja' => Input::get('unit_kerja'),
                'job_title' => Input::get('job_title'),
            ]);
        } else {
            $r->update([
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'password' => Hash::make(Input::get('password')),
                'status_operator' => Input::get('status_operator'),
                'no_hp' => Input::get('no_hp'),
                'alamat' => Input::get('alamat'),
                'unit_kerja' => Input::get('unit_kerja'),
                'job_title' => Input::get('job_title'),
            ]);
        }
//        return redirect('operator/' . $id . '/edit')->with('status', 'Update operator berhasil');
        return redirect('operatorlist')->with('status', 'Update operator berhasil');
    }

    public function verifyuser($id) {
//        return Crypt::decrypt($id);

        $r = Operator::FindOrFail(Crypt::decrypt($id));
        $r->update([
            'status_operator' => 1
        ]);
        return redirect('operatorlist')->with('status', 'Verifikasi Berhasil');
    }

    public function batalverifyuser($id) {
//        return Crypt::decrypt($id);

        $r = Operator::FindOrFail(Crypt::decrypt($id));
        $r->update([
            'status_operator' => 0
        ]);
        return redirect('operatorlist')->with('status', 'Verifikasi Berhasil Dibatalkan');
    }

    public function instansi() {
        $data['instansi'] = \App\Setupaplikasi::findOrFail(1);
        return view('admin.indexaplikasi', $data);
    }

    public function postaddoperator(Request $request) {
//        return Input::all();
        Operator::create(
                [
                    'nama' => Input::get('nama'),
                    'email' => Input::get('email'),
                    'password' => Hash::make(Input::get('password')),
                    'no_hp' => Input::get('no_hp'),
                    'alamat' => Input::get('alamat'),
                    'unit_kerja' => Input::get('unit_kerja'),
                    'job_title' => Input::get('job_title')
        ]);

        return redirect('operator/add')->with('status', 'Entri operator berhasil');
    }

    public function detaillayanan($id) {

        $data['pelayanan'] = Jenislayanan::findOrFail($id);
        $data['persyaratan'] = Jenislayanan::find($id)->persyaratan;
        $data['mekanisme'] = Jenislayanan::find($id)->mekanisme;
        $data['formisian'] = Jenislayanan::find($id)->formisian;
        $data['formulir'] = Jenislayanan::find($id)->formulir;
        $data['dokumenupload'] = Jenislayanan::find($id)->dokumenupload;
        $data['statuspengajuan'] = \App\Statuspengajuan::orderBy('id')->get();
        $data['soplayanan'] = Jenislayanan::find($id)->soplayanan;
        $data['dokumenlayanan'] = Jenislayanan::find($id)->dokumenlayanan;
        return view('layanan.detail', $data);
    }

    public function operatorlist() {
        $data['user_list'] = Operator::whereNull('deleted_at')->get();
        return view('operator.operatorlist', $data);
    }

    public function hapusdata($jenis) {

        switch ($jenis) {
            case 'Persyaratan':
                $jenislayanan = Syaratlayanan::findOrFail(Input::get('id'));
                $jenislayanan->delete();
                return 1;
                break;
            case 'Mekanisme':
                $jenislayanan = Mekanismelayanan::findOrFail(Input::get('id'));
                $jenislayanan->delete();
                return 1;
                break;
            case 'Formulir':
                $jenislayanan = Formulirlayanan::findOrFail(Input::get('id'));
                $jenislayanan->delete();
                return 1;
                break;
            case 'Formisian':
                $jenislayanan = Formisian::findOrFail(Input::get('id'));
                $jenislayanan->delete();
                return 1;
                break;
            case 'Dokumenupload':
                $jenislayanan = Dokumenupload::findOrFail(Input::get('id'));
                $jenislayanan->delete();
                return 1;
                break;
            case 'Proseslayanan':
                $jenislayanan = Soplayanan::findOrFail(Input::get('id'));
                $jenislayanan->delete();
                return 1;
                break;
            case 'Dokumenlayanan':
                $jenislayanan = Dokumenlayanan::findOrFail(Input::get('id'));
                $jenislayanan->delete();
                return 1;
                break;

            default:
                break;
        }
    }

    public function nonaktif_layanan($id) {


        $r = Jenislayanan::findOrFail(Crypt::decrypt($id));
        $r->update([
            'status_layanan' => 0
        ]);

        return redirect('jenislayanan')->with('status', 'Layanan berhasil dinonaktifkan');
    }

    public function aktif_layanan($id) {
        $r = Jenislayanan::findOrFail(Crypt::decrypt($id));
        $r->update([
            'status_layanan' => 1
        ]);

        return redirect('jenislayanan')->with('status', 'Layanan berhasil diaktifkan');
    }

    public function indexbantuan() {
        $data['bantuan'] = Bantuan::all();
        return view('backEnd.jenislayanan.bantuan', $data);
    }

    public function bantuan() {
        $data['pertanyaan'] = Bantuan::where('status', '=', 1)->get();
        return view('bantuan', $data);
    }

    public function downloadpetunjuk($id) {

        $d = Jenislayanan::findOrFail(Crypt::decrypt($id));
        $file = public_path($d->link_dokumen);

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'petunjuk_layanan.pdf', $headers);
    }

    public function downloadformulir($id) {
        $d = Formulirlayanan::findOrFail(Crypt::decrypt($id));
        $file = public_path($d->link_file);


        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, str_replace('\\', '_', $d->link_file), $headers);
    }

    public function updateinstansi(Request $request, $id) {

//        return Input::all();
//        return Crypt::decrypt($id);
        $d = Setupaplikasi::findOrFail(Crypt::decrypt($id));

        if (Input::hasfile('link_logo')) {
            $ext = Input::file('link_logo')->getClientOriginalExtension();
            $filenamex = "logo_" . str_replace(" ", "_", Input::file('link_logo')->getClientOriginalName());

            if ($ext == 'jpg' || $ext == 'png') {
                Input::file('link_logo')->move(public_path('/img'), $filenamex);
            }
            $d->update([
                'no_prop' => Input::get('no_prop'),
                'no_kab' => Input::get('no_kab'),
                'nama_pemerintah' => Input::get('nama_pemerintah'),
                'nama_dinas' => Input::get('nama_dinas'),
                'nama_kadis' => Input::get('nama_kadis'),
                'nip_kadis' => Input::get('nip_kadis'),
                'alamat' => Input::get('alamat'),
                'no_telp' => Input::get('no_telp'),
                'no_wa' => Input::get('no_wa'),
                'nama_kabupaten' => Input::get('nama_kabupaten'),
                'alamat_website' => Input::get('alamat_website'),
                'link_logo' => "img/$filenamex",
//                'logo_index' => Input::get('logo_index'),
                'slogan_header' => Input::get('slogan_header'),
                'nama_propinsi' => Input::get('nama_propinsi')
            ]);
        } else if (Input::hasfile('logo_index')) {
            $ext = Input::file('logo_index')->getClientOriginalExtension();
            $filenamex = "logoindex_" . str_replace(" ", "_", Input::file('logo_index')->getClientOriginalName());

            if ($ext == 'jpg' || $ext == 'png') {
                Input::file('logo_index')->move(public_path('/img'), $filenamex);
            }
            $d->update([
                'no_prop' => Input::get('no_prop'),
                'no_kab' => Input::get('no_kab'),
                'nama_pemerintah' => Input::get('nama_pemerintah'),
                'nama_dinas' => Input::get('nama_dinas'),
                'nama_kadis' => Input::get('nama_kadis'),
                'nip_kadis' => Input::get('nip_kadis'),
                'alamat' => Input::get('alamat'),
                'no_telp' => Input::get('no_telp'),
                'no_wa' => Input::get('no_wa'),
                'nama_kabupaten' => Input::get('nama_kabupaten'),
                'alamat_website' => Input::get('alamat_website'),
//                'link_logo' => Input::get('link_logo'),
                'logo_index' => "img/$filenamex",
                'slogan_header' => Input::get('slogan_header'),
                'nama_propinsi' => Input::get('nama_propinsi')
            ]);
        } else if (Input::hasfile('logo_index') && Input::hasfile('link_logo')) {
            $ext = Input::file('link_logo')->getClientOriginalExtension();
            $filenamex = "logo_" . str_replace(" ", "_", Input::file('link_logo')->getClientOriginalName());

            if ($ext == 'jpg' || $ext == 'png') {
                Input::file('link_logo')->move(public_path('/img'), $filenamex);
            }

            $extxx = Input::file('logo_index')->getClientOriginalExtension();
            $filenamexx = "logoindex_" . str_replace(" ", "_", Input::file('logo_index')->getClientOriginalName());

            if ($extxx == 'jpg' || $extxx == 'png') {
                Input::file('logo_index')->move(public_path('/img'), $filenamexx);
            }

            $d->update([
                'no_prop' => Input::get('no_prop'),
                'no_kab' => Input::get('no_kab'),
                'nama_pemerintah' => Input::get('nama_pemerintah'),
                'nama_dinas' => Input::get('nama_dinas'),
                'nama_kadis' => Input::get('nama_kadis'),
                'nip_kadis' => Input::get('nip_kadis'),
                'alamat' => Input::get('alamat'),
                'no_telp' => Input::get('no_telp'),
                'no_wa' => Input::get('no_wa'),
                'nama_kabupaten' => Input::get('nama_kabupaten'),
                'alamat_website' => Input::get('alamat_website'),
                'link_logo' => "img/$filenamex",
                'logo_index' => "img/$filenamexx",
                'slogan_header' => Input::get('slogan_header'),
                'nama_propinsi' => Input::get('nama_propinsi')
            ]);
        } else {
            $d->update([
                'no_prop' => Input::get('no_prop'),
                'no_kab' => Input::get('no_kab'),
                'nama_pemerintah' => Input::get('nama_pemerintah'),
                'nama_dinas' => Input::get('nama_dinas'),
                'nama_kadis' => Input::get('nama_kadis'),
                'nip_kadis' => Input::get('nip_kadis'),
                'alamat' => Input::get('alamat'),
                'no_telp' => Input::get('no_telp'),
                'no_wa' => Input::get('no_wa'),
                'nama_kabupaten' => Input::get('nama_kabupaten'),
                'alamat_website' => Input::get('alamat_website'),
//                'link_logo' => Input::get('link_logo'),
//                'logo_index' => Input::get('logo_index'),
                'slogan_header' => Input::get('slogan_header'),
                'nama_propinsi' => Input::get('nama_propinsi')
            ]);
        }
        return redirect('instansi');
    }

}
