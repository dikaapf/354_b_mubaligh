<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Dokumenlayanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class DokumenlayananController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $dokumenlayanan = Dokumenlayanan::all();

        return view('backEnd.dokumenlayanan.index', compact('dokumenlayanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.dokumenlayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Dokumenlayanan::create($request->all());

        Session::flash('message', 'Dokumenlayanan added!');
        Session::flash('status', 'success');

        return redirect('dokumenlayanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dokumenlayanan = Dokumenlayanan::findOrFail($id);

        return view('backEnd.dokumenlayanan.show', compact('dokumenlayanan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dokumenlayanan = Dokumenlayanan::findOrFail($id);

        return view('backEnd.dokumenlayanan.edit', compact('dokumenlayanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $dokumenlayanan = Dokumenlayanan::findOrFail($id);
        $dokumenlayanan->update($request->all());

        Session::flash('message', 'Dokumenlayanan updated!');
        Session::flash('status', 'success');

        return redirect('dokumenlayanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dokumenlayanan = Dokumenlayanan::findOrFail($id);

        $dokumenlayanan->delete();

        Session::flash('message', 'Dokumenlayanan deleted!');
        Session::flash('status', 'success');

        return redirect('dokumenlayanan');
    }

}
