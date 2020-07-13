<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jenislayanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Pengajuan;
use App\Dokumenlayanan;
use App\Dokumenupload;
use App\Formisian;
use App\Formulirlayanan;
use App\Mekanismelayanan;
use App\Soplayanan;
use App\Syaratlayanan;

class JenislayananController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $jenislayanan = Jenislayanan::all();

        return view('backEnd.jenislayanan.index', compact('jenislayanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        return view('backEnd.jenislayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        Jenislayanan::create($request->all());

        Session::flash('message', 'Jenislayanan added!');
        Session::flash('status', 'success');

        return redirect('jenislayanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id) {
        $jenislayanan = Jenislayanan::findOrFail($id);

        return view('backEnd.jenislayanan.show', compact('jenislayanan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id) {
//        $jenislayanan = Jenislayanan::findOrFail(Crypt::decrypt($id));
        $data['jenislayanan'] = Jenislayanan::findOrFail(Crypt::decrypt($id));
        if ($data['jenislayanan']->status_layanan == 1) {
            return redirect('jenislayanan')->with('status', 'Layanan masih berstatus aktif. Untuk melakukan pengeditan silahkan nonaktifkan layanan terlebih dahulu');
        } else {
            $data['persyaratan'] = Jenislayanan::find(Crypt::decrypt($id))->persyaratan;
            $data['mekanisme'] = Jenislayanan::find(Crypt::decrypt($id))->mekanisme;
            $data['formulir'] = Jenislayanan::find(Crypt::decrypt($id))->formulir;
            $data['formisian'] = Jenislayanan::find(Crypt::decrypt($id))->formisian;
            $data['dokumenupload'] = Jenislayanan::find(Crypt::decrypt($id))->dokumenupload;
            $data['statuspengajuan'] = \App\Statuspengajuan::orderBy('id')->get();
            $data['soplayanan'] = Jenislayanan::find(Crypt::decrypt($id))->soplayanan;
            $data['dokumenlayanan'] = Jenislayanan::find(Crypt::decrypt($id))->dokumenlayanan;

            return view('backEnd.jenislayanan.edit', $data);
        }
    }

    public function postpengajuan_layanan() {
//        return count(Input::get('nama_persyaratan'));
//        return Input::all();
//        if (Input::hasfile('link_dokumen')) {
//            $filename = "dokumen_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_dokumen')->getClientOriginalName());
//            $ext = Input::file('link_dokumen')->getClientOriginalExtension();
//            if ($ext == 'pdf') {
//                Input::file('link_dokumen')->move(public_path('/files/layanan'), $filename);
//            } else {
//                return redirect('jenislayanan/create')->with('status', 'Dokumen petunjuk harus berformat pdf');
//            }
//        }
        //
        if (Input::hasfile('link_gambar')) {
            $filegambar = "gambar_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_gambar')->getClientOriginalName());
            $extgambar = Input::file('link_gambar')->getClientOriginalExtension();
            if ($extgambar == 'jpg' || $extgambar == 'png' || $extgambar == 'bmp' || $extgambar == 'JPG') {
                Input::file('link_gambar')->move(public_path('/files/layanan'), $filegambar);
            } else {
                return redirect('jenislayanan/create')->with('status', 'Dokumen petunjuk harus berformat image (jpg,png,bmp)');
            }
        }

        if (Input::hasfile('link_file')) {
            for ($i = 0; $i < count(Input::get('nama_formulir')); $i++) {
                $fileexcel[$i] = "formulir_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_file')[$i]->getClientOriginalName());
                $extfile[$i] = Input::file('link_file')[$i]->getClientOriginalExtension();
                if ($extfile[$i] == 'xls' || $extfile[$i] == 'xlsx' || $extfile[$i] == 'pdf' || $extfile[$i] == 'doc' || $extfile[$i] == 'docx' || $extfile[$i] == 'rtf') {
                    Input::file('link_file')[$i]->move(public_path('/files/layanan'), $fileexcel[$i]);
                } else {
                    return redirect('jenislayanan/create')->with('status', 'Formulir harus berformat dokumen (pdf,excell,word)');
                }
            }
        }




        $dt = new Jenislayanan();

        $dt->nama_layanan = Input::get('nama_layanan');
        $dt->deskripsi = Input::get('deskripsi');
        $dt->kirim_dok = Input::get('kirim_dok') != null ? 1 : 0;
        $dt->ambil_dok = Input::get('ambil_dok') != null ? 1 : 0;
        $dt->info_dok = Input::get('info_dok') != null ? 1 : 0;
        $dt->kirim_syarat = Input::get('kirim_syarat') != null ? 1 : 0;
        $dt->link_dokumen = "files\layanan\$filename";
        $dt->link_gambar = "files/layanan/$filegambar";
        $dt->save();
        $last_id = $dt->id;
        if (count(Input::get('nama_persyaratan')) > 0) {
            foreach (Input::get('nama_persyaratan')as $k) {
//            print_r($k);
                if ($k) {
                    Syaratlayanan::create(
                            [
                                'jenislayanan_id' => $last_id,
                                'nama_persyaratan' => $k
                            ]
                    );
                }
            }
        }

        if (count(Input::get('nama_mekanisme')) > 0) {
            foreach (Input::get('nama_mekanisme')as $k) {
//            print_r($k);
                if ($k) {
                    Mekanismelayanan::create(
                            [
                                'jenislayanan_id' => $last_id,
                                'nama_mekanisme' => $k
                            ]
                    );
                }
            }
        }
        if (count(Input::get('nama_formulir')) > 0) {
            if (Input::hasfile('link_file')) {
                for ($i = 0; $i < count(Input::get('nama_formulir')); $i++) {
                    $fileexcel[$i] = "formulir_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_file')[$i]->getClientOriginalName());
                    if (Input::get('nama_formulir')[$i] != null) {
                        Formulirlayanan::create(
                                [
                                    'jenislayanan_id' => $last_id,
                                    'nama_formulir' => Input::get('nama_formulir')[$i],
                                    'deskripsi_formulir' => Input::get('deskripsi_formulir')[$i],
                                    'link_file' => "files\layanan\\" . $fileexcel[$i],
                                ]
                        );
                    }
                }
            }
        }

        if (count(Input::get('nama_formisian')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_formisian')); $i++) {
                if (Input::get('nama_formisian')[$i] != null) {
                    Formisian::create(
                            [
                                'jenislayanan_id' => $last_id,
                                'nama_formisian' => Input::get('nama_formisian')[$i],
                                'ket_form' => Input::get('ket_form')[$i],
                            ]
                    );
                }
            }
        }

        if (count(Input::get('nama_dokumen')) > 0) {

            foreach (Input::get('nama_dokumen')as $k) {
//            print_r($k);
                if ($k) {
                    Dokumenupload::create(
                            [
                                'jenislayanan_id' => $last_id,
                                'nama_dokumen' => $k
                            ]
                    );
                }
            }
        }



        if (count(Input::get('nama_proses')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_proses')); $i++) {
                if (Input::get('nama_proses')[$i] != null) {
                    Soplayanan::create(
                            [
                                'jenislayanan_id' => $last_id,
                                'nama_proses' => Input::get('nama_proses')[$i],
                                'deskripsi_proses' => Input::get('deskripsi_proses')[$i],
                            ]
                    );
                }
            }
        }

        if (count(Input::get('nama_dok_download')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_dok_download')); $i++) {
                if (Input::get('nama_dok_download')[$i] != null) {
                    Dokumenlayanan::create(
                            [
                                'jenislayanan_id' => $last_id,
                                'nama_dok_download' => Input::get('nama_dok_download')[$i],
                                'dokumen_deskripsi' => Input::get('dokumen_deskripsi')[$i],
                            ]
                    );
                }
            }
        }


        return redirect('jenislayanan')->with('status', 'Layanan berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request) {
//        return Input::all(); 
        if (Input::hasfile('link_gambar')) {
            $filegambar = "gambar_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_gambar')->getClientOriginalName());
            $filegambar;
            $extgambar = Input::file('link_gambar')->getClientOriginalExtension();
            if ($extgambar == 'jpg' || $extgambar == 'png' || $extgambar == 'bmp' || $extgambar == 'JPG') {
                Input::file('link_gambar')->move(public_path('/files/layanan'), $filegambar);
                Jenislayanan::where('id', '=', Input::get('id'))
                        ->update([
                            'link_gambar' => "files/layanan/$filegambar",
                ]);
            } else {
                return redirect('jenislayanan' . '/' . Crypt::encrypt(Input::get('id')) . '/edit')->with('status', 'Gambar harus berformat image (jpg,png,bmp)');
            }
        }
        if (Input::hasfile('link_dokumen')) {
            $filename = "dokumen_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_dokumen')->getClientOriginalName());
            $ext = Input::file('link_dokumen')->getClientOriginalExtension();
            if ($ext == 'pdf') {
                Input::file('link_dokumen')->move(public_path('/files/layanan'), $filename);
                Jenislayanan::where('id', '=', Input::get('id'))
                        ->update([
                            'link_dokumen' => "files\layanan\$filename",
                ]);
            } else {
                return redirect('jenislayanan' . '/' . Crypt::encrypt(Input::get('id')) . '/edit')->with('status', 'File Petunjuk harus berformat pdf');
            }
        }
        if (Input::hasfile('link_file')) {
            for ($i = 0; $i < count(Input::get('nama_formulir')); $i++) {
                $fileexcel[$i] = "formulir_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_file')[$i]->getClientOriginalName());
                $extfile[$i] = Input::file('link_file')[$i]->getClientOriginalExtension();
                if ($extfile[$i] == 'xls' || $extfile[$i] == 'xlsx' || $extfile[$i] == 'pdf' || $extfile[$i] == 'doc' || $extfile[$i] == 'docx' || $extfile[$i] == 'rtf') {
                    Input::file('link_file')[$i]->move(public_path('/files/layanan'), $fileexcel[$i]);
                } else {
                    return redirect('jenislayanan' . '/' . Crypt::encrypt(Input::get('id')) . '/edit')->with('status', 'Formulir harus berformat dokumen (pdf,excell,word)');
                }
            }
        }

        Jenislayanan::where('id', '=', Input::get('id'))
                ->update([
                    'nama_layanan' => Input::get('nama_layanan'),
                    'deskripsi' => Input::get('deskripsi'),
                    'kirim_dok' => Input::get('kirim_dok') != null ? 1 : 0,
                    'ambil_dok' => Input::get('ambil_dok') != null ? 1 : 0,
                    'info_dok' => Input::get('info_dok') != null ? 1 : 0,
                    'kirim_syarat' => Input::get('kirim_syarat') != null ? 1 : 0,
        ]);

        if (count(Input::get('nama_persyaratan_edit')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_persyaratan_edit')); $i++) {
                Syaratlayanan::where('id', '=', Input::get('persyaratan_id')[$i])
                        ->update([
                            'nama_persyaratan' => Input::get('nama_persyaratan_edit')[$i],
//                    'deskripsi' => Input::get('deskripsi'),
                ]);
            }
        }
        if (count(Input::get('nama_persyaratan')) > 0) {
            foreach (Input::get('nama_persyaratan')as $k) {
//            print_r($k);
                if ($k) {
                    Syaratlayanan::create(
                            [
                                'jenislayanan_id' => Input::get('id'),
                                'nama_persyaratan' => $k
                            ]
                    );
                }
            }
        }
        if (count(Input::get('nama_mekanisme_edit')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_mekanisme_edit')); $i++) {
                Mekanismelayanan::where('id', '=', Input::get('mekanisme_id')[$i])
                        ->update([
                            'nama_mekanisme' => Input::get('nama_mekanisme_edit')[$i],
                ]);
            }
        }
        if (count(Input::get('nama_mekanisme')) > 0) {
            foreach (Input::get('nama_mekanisme')as $k) {
//            print_r($k);
                if ($k) {
                    Mekanismelayanan::create(
                            [
                                'jenislayanan_id' => Input::get('id'),
                                'nama_mekanisme' => $k
                            ]
                    );
                }
            }
        }
        if (Input::hasfile('link_file_edit')) {
            for ($i = 0; $i < count(Input::get('nama_formulir')); $i++) {
                $fileexcel[$i] = "formulir_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_file_edit')[$i]->getClientOriginalName());
                $extfile[$i] = Input::file('link_file_edit')[$i]->getClientOriginalExtension();
                if ($extfile[$i] == 'xls' || $extfile[$i] == 'xlsx') {
                    Input::file('link_file_edit')[$i]->move(public_path('/files/layanan'), $fileexcel[$i]);
                    Formulirlayanan::where('id', '=', Input::get('id'))
                            ->update([
                                'link_file' => "files\layanan\\" . $fileexcel[$i],
                    ]);
                } else {
                    return redirect('jenislayanan' . '/' . Crypt::encrypt(Input::get('id')) . '/edit')->with('status', 'Formulir harus berformat excel');
                }
            }
        }
        if (Input::hasfile('link_file')) {
            for ($i = 0; $i < count(Input::get('nama_formulir')); $i++) {
                $fileexcel[$i] = "formulir_" . date('Ymdhis') . '_' . str_replace(" ", "_", Input::file('link_file')[$i]->getClientOriginalName());
                if (Input::get('nama_formulir')[$i] != null) {
                    Formulirlayanan::create(
                            [
                                'jenislayanan_id' => Input::get('id'),
                                'nama_formulir' => Input::get('nama_formulir')[$i],
                                'deskripsi_formulir' => Input::get('deskripsi_formulir')[$i],
                                'link_file' => "files\layanan\\" . $fileexcel[$i],
                            ]
                    );
                }
            }
        }

        if (count(Input::get('nama_formisian_edit')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_formisian_edit')); $i++) {
                Formisian::where('id', '=', Input::get('formisian_id')[$i])
                        ->update([
                            'nama_formisian' => Input::get('nama_formisian_edit')[$i],
                            'ket_form' => Input::get('ket_form_edit')[$i],
                ]);
            }
        }

        if (count(Input::get('nama_formisian')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_formisian')); $i++) {
                if (Input::get('nama_formisian')[$i] != null) {
                    Formisian::create(
                            [
                                'jenislayanan_id' => Input::get('id'),
                                'nama_formisian' => Input::get('nama_formisian')[$i],
                                'ket_form' => Input::get('ket_form')[$i],
                            ]
                    );
                }
            }
        }

        if (count(Input::get('nama_dokumen_edit')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_dokumen_edit')); $i++) {
                Dokumenupload::where('id', '=', Input::get('dokumenupload_id')[$i])
                        ->update([
                            'nama_dokumen' => Input::get('nama_dokumen_edit')[$i],
                ]);
            }
        }

        if (count(Input::get('nama_dokumen')) > 0) {

            foreach (Input::get('nama_dokumen')as $k) {
//            print_r($k);
                if ($k) {
                    Dokumenupload::create(
                            [
                                'jenislayanan_id' => Input::get('id'),
                                'nama_dokumen' => $k
                            ]
                    );
                }
            }
        }

        if (count(Input::get('nama_proses_edit')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_proses_edit')); $i++) {
                Soplayanan::where('id', '=', Input::get('soplayanan_id')[$i])
                        ->update([
                            'nama_proses' => Input::get('nama_proses_edit')[$i],
                            'deskripsi_proses' => Input::get('deskripsi_proses_edit')[$i],
                ]);
            }
        }

        if (count(Input::get('nama_proses')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_proses')); $i++) {
                if (Input::get('nama_proses')[$i] != null) {
                    Soplayanan::create(
                            [
                                'jenislayanan_id' => Input::get('id'),
                                'nama_proses' => Input::get('nama_proses')[$i],
                                'deskripsi_proses' => Input::get('deskripsi_proses')[$i],
                            ]
                    );
                }
            }
        }

        if (count(Input::get('nama_dok_download_edit')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_dok_download_edit')); $i++) {
                Dokumenlayanan::where('id', '=', Input::get('dokumenlayanan_id')[$i])
                        ->update([
                            'nama_dok_download' => Input::get('nama_dok_download_edit')[$i],
                            'dokumen_deskripsi' => Input::get('dokumen_deskripsi_edit')[$i],
                ]);
            }
        }

        if (count(Input::get('nama_dok_download')) > 0) {
            for ($i = 0; $i < count(Input::get('nama_dok_download')); $i++) {
                if (Input::get('nama_dok_download')[$i] != null) {
                    Dokumenlayanan::create(
                            [
                                'jenislayanan_id' => Input::get('id'),
                                'nama_dok_download' => Input::get('nama_dok_download')[$i],
                                'dokumen_deskripsi' => Input::get('dokumen_deskripsi')[$i],
                            ]
                    );
                }
            }
        }

        return redirect('jenislayanan' . '/' . Crypt::encrypt(Input::get('id')) . '/edit')->with('status', 'Update berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id) {
        $cek = Pengajuan::where('jenislayanan_id', '=', ($id))->count();
        if ($cek > 0) {
            return redirect('jenislayanan')->with('status', 'Tidak dapat dihapus karena sudah ada pengajuan');
        } else {
            $jenislayanan = Jenislayanan::findOrFail($id);

            $jenislayanan->delete();

            Session::flash('message', 'Jenislayanan deleted!');
            Session::flash('status', 'success');

            return redirect('jenislayanan')->with('status', 'Berhasil DIhapus');
        }
    }

}
