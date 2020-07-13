<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Suratmasuk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class SuratmasukController extends Controller {

    public function __construct() {
//        $this->middleware('auth:admin');
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $suratmasuk = Suratmasuk::all();

        return view('backEnd.suratmasuk.index', compact('suratmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('backEnd.suratmasuk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'tgl_surat' => 'required',
            'asal_surat' => 'required',
            'perihal_surat' => 'required',
            'tgl_terima' => 'required',
        ]);
        Suratmasuk::create($request->all());

        Session::flash('message', 'Suratmasuk added!');
        Session::flash('status', 'success');

        return redirect('suratmasuk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id) {
        $suratmasuk = Suratmasuk::findOrFail($id);

        return view('backEnd.suratmasuk.show', compact('suratmasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id) {
        $suratmasuk = Suratmasuk::findOrFail($id);

        return view('backEnd.suratmasuk.edit', compact('suratmasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request) {

        $suratmasuk = Suratmasuk::findOrFail($id);
        $suratmasuk->update($request->all());

        Session::flash('message', 'Suratmasuk updated!');
        Session::flash('status', 'success');

        return redirect('suratmasuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id) {
        $suratmasuk = Suratmasuk::findOrFail($id);

        $suratmasuk->delete();

        Session::flash('message', 'Suratmasuk deleted!');
        Session::flash('status', 'success');

        return redirect('suratmasuk');
    }

    public function upload($id) {

        $suratmasuk = Suratmasuk::findOrFail($id);

        return view('backEnd.suratmasuk.upload', compact('suratmasuk'));
    }

    public function postupload($id, Request $request) {
        if (Input::hasfile('datafile')) {
            echo "ada";
            print_r($request->all());
            $filename = str_replace(" ", "_", Input::file('datafile')->getClientOriginalName());
            $ext = Input::file('datafile')->getClientOriginalExtension();
            if ($ext == 'JPG' || $ext == 'jpg' || $ext == 'pdf') {
                Input::file('datafile')->move(public_path('/files/suratmasuk'), $filename);
                $suratmasuk = Suratmasuk::findOrFail($id);
                print_r($suratmasuk);
                $suratmasuk->update([
                    'link_arsip' => ('/files/suratmasuk/') . $filename
                ]);

                return redirect('suratmasuk/' . $id)->with('status', 'Upload Arsip Berhasil');
            } else {
                echo "file tidak support";
            }
        } else {
            echo "tidak ada";
        }
    }

    public function detail($tanggal) {
        $suratmasuk = Suratmasuk::where('tgl_terima', '=', $tanggal)->get();

        return view('backEnd.suratmasuk.detail', compact('suratmasuk'));
    }

    public function detailbulan($bln) {
        $PDO = DB::connection('mysql')->getPdo();
        $billingStmt = $PDO->prepare("
    
          SELECT * FROM suratmasuks WHERE month(tgl_surat)=" . $bln . " 
 
          ");
        $billingStmt->execute();
        $suratmasuk = $billingStmt->fetchAll((\PDO::FETCH_OBJ));

        return view('backEnd.suratmasuk.detailbulan', compact('suratmasuk'));
    }

}
