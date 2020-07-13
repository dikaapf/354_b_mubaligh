<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengumuman;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PengumumanController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin', [
            'except' => [
//                'indexpublic',
//                'detaillayanan',
//                'bantuan',
//                'downloadpetunjuk',
//                'downloadformulir'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $pengumuman = Pengumuman::all();

        return view('backEnd.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('backEnd.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        Pengumuman::create($request->all());

        Session::flash('message', 'Pengumuman added!');
        Session::flash('status', 'success');

        return redirect('pengumuman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id) {
        $pengumuman = Pengumuman::findOrFail($id);

        return view('backEnd.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id) {
        $pengumuman = Pengumuman::findOrFail($id);

        return view('backEnd.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request) {

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update($request->all());

        Session::flash('message', 'Pengumuman updated!');
        Session::flash('status', 'success');

        return redirect('pengumuman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id) {
        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->delete();

        Session::flash('message', 'Pengumuman deleted!');
        Session::flash('status', 'success');

        return redirect('pengumuman');
    }

}
