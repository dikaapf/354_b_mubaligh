<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Dokuman;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class DokumenController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $dokumen = Dokuman::all();

        return view('backEnd.dokumen.index', compact('dokumen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Dokuman::create($request->all());

        Session::flash('message', 'Dokuman added!');
        Session::flash('status', 'success');

        return redirect('dokumen');
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
        $dokuman = Dokuman::findOrFail($id);

        return view('backEnd.dokumen.show', compact('dokuman'));
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
        $dokuman = Dokuman::findOrFail($id);

        return view('backEnd.dokumen.edit', compact('dokuman'));
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
        
        $dokuman = Dokuman::findOrFail($id);
        $dokuman->update($request->all());

        Session::flash('message', 'Dokuman updated!');
        Session::flash('status', 'success');

        return redirect('dokumen');
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
        $dokuman = Dokuman::findOrFail($id);

        $dokuman->delete();

        Session::flash('message', 'Dokuman deleted!');
        Session::flash('status', 'success');

        return redirect('dokumen');
    }

}
