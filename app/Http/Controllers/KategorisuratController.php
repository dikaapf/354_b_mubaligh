<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kategorisurat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class KategorisuratController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->middleware('auth:');    
    }
    public function index() {

        return view('backEnd.kategorisurat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $kategorisurat = Kategorisurat::all();
        return view('backEnd.kategorisurat.create', compact('kategorisurat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        Kategorisurat::create($request->all());

        Session::flash('message', 'Kategorisurat added!');
        Session::flash('status', 'success');

        return redirect('kategorisurat/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id) {
        $kategorisurat = Kategorisurat::findOrFail($id);

        return view('backEnd.kategorisurat.show', compact('kategorisurat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id) {
        $kategorisurat = Kategorisurat::findOrFail($id);

        return view('backEnd.kategorisurat.edit', compact('kategorisurat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request) {

        $kategorisurat = Kategorisurat::findOrFail($id);
        $kategorisurat->update($request->all());

        Session::flash('message', 'Kategorisurat updated!');
        Session::flash('status', 'success');

        return redirect('kategorisurat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id) {
        $kategorisurat = Kategorisurat::findOrFail($id);

        $kategorisurat->delete();

        Session::flash('message', 'Kategorisurat deleted!');
        Session::flash('status', 'success');

        return redirect('kategorisurat');
    }

}
