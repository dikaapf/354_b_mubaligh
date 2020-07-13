<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pengajar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PengajarController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
//        $this->middleware('auth:operator', [
//            'except' => [
//                'indexoperator',
//                'create',
//                'store',
//                'show',
//                'edit',
//                'update',
//                'destroy',
//        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $pengajar = Pengajar::all();

        return view('backEnd.pengajar.index', compact('pengajar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('backEnd.pengajar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        Pengajar::create($request->all());

        Session::flash('message', 'Pengajar added!');
        Session::flash('status', 'success');

        return redirect('pengajar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id) {
        $pengajar = Pengajar::findOrFail($id);

        return view('backEnd.pengajar.show', compact('pengajar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id) {
        $pengajar = Pengajar::findOrFail($id);

        return view('backEnd.pengajar.edit', compact('pengajar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request) {

        $pengajar = Pengajar::findOrFail($id);
        $pengajar->update($request->all());

        Session::flash('message', 'Pengajar updated!');
        Session::flash('status', 'success');

        return redirect('pengajar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id) {
        $pengajar = Pengajar::findOrFail($id);

        $pengajar->delete();

        Session::flash('message', 'Pengajar deleted!');
        Session::flash('status', 'success');

        return redirect('pengajar');
    }

}
