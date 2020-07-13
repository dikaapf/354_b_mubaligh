<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Suratkeluar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;

class SuratkeluarController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $suratkeluar = Suratkeluar::all();

        return view('backEnd.suratkeluar.index', compact('suratkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('backEnd.suratkeluar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        Suratkeluar::create($request->all());

        Session::flash('message', 'Suratkeluar added!');
        Session::flash('status', 'success');

        return redirect('suratkeluar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id) {
        $suratkeluar = Suratkeluar::findOrFail($id);

        return view('backEnd.suratkeluar.show', compact('suratkeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id) {
        $suratkeluar = Suratkeluar::findOrFail($id);

        return view('backEnd.suratkeluar.edit', compact('suratkeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request) {

        $suratkeluar = Suratkeluar::findOrFail($id);
        $suratkeluar->update($request->all());

        Session::flash('message', 'Suratkeluar updated!');
        Session::flash('status', 'success');

        return redirect('suratkeluar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id) {
        $suratkeluar = Suratkeluar::findOrFail($id);

        $suratkeluar->delete();

        Session::flash('message', 'Suratkeluar deleted!');
        Session::flash('status', 'success');

        return redirect('suratkeluar');
    }

    public function upload($id) {

        $suratkeluar = Suratkeluar::findOrFail($id);

        return view('backEnd.suratkeluar.upload', compact('suratkeluar'));
    }

    public function postupload($id, Request $request) {
        if (Input::hasfile('datafile')) {
            echo "ada";
//            print_r($request->all());
            $filename = str_replace(" ", "_", Input::file('datafile')->getClientOriginalName());
            $ext = Input::file('datafile')->getClientOriginalExtension();
            if ($ext == 'JPG' || $ext == 'jpg' || $ext == 'pdf') {
                Input::file('datafile')->move(public_path('/files/suratkeluar'), $filename);
                $suratkeluar = Suratkeluar::findOrFail($id);
                print_r($suratkeluar);
                $suratkeluar->update([
                    'link_arsip' => ('/files/suratkeluar/') . $filename
                ]);

                return redirect('suratkeluar/' . $id)->with('status', 'Upload Arsip Berhasil');
            } else {
                echo "file tidak support";
            }
        } else {
            echo "tidak ada";
        }
    }

}
