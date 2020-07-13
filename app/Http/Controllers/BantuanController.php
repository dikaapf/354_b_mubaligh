<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bantuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class BantuanController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data['instansi'] = \App\Setupaplikasi::findOrFail(1);
        $data['pertanyaan'] = Bantuan::where('status', '=', 1)->OrderBy('id', 'asc')->get();
        return view('bantuan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('backEnd.bantuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        Bantuan::create($request->all());

        Session::flash('message', 'Bantuan added!');
        Session::flash('status', 'success');

        return redirect('help');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id) {
        $bantuan = Bantuan::findOrFail($id);

        return view('backEnd.bantuan.show', compact('bantuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id) {
        $bantuan = Bantuan::findOrFail($id);

        return view('backEnd.bantuan.edit', compact('bantuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request) {

        $bantuan = Bantuan::findOrFail($id);
        $bantuan->update($request->all());

        Session::flash('message', 'Bantuan updated!');
        Session::flash('status', 'success');

        return redirect('help');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id) {
        $bantuan = Bantuan::findOrFail($id);

        $bantuan->delete();

        Session::flash('message', 'Bantuan deleted!');
        Session::flash('status', 'success');

        return redirect('help');
    }

}
