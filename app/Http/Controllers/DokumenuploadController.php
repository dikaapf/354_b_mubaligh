<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Dokumenupload;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class DokumenuploadController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $dokumenupload = Dokumenupload::all();

        return view('backEnd.dokumenupload.index', compact('dokumenupload'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.dokumenupload.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Dokumenupload::create($request->all());

        Session::flash('message', 'Dokumenupload added!');
        Session::flash('status', 'success');

        return redirect('dokumenupload');
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
        $dokumenupload = Dokumenupload::findOrFail($id);

        return view('backEnd.dokumenupload.show', compact('dokumenupload'));
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
        $dokumenupload = Dokumenupload::findOrFail($id);

        return view('backEnd.dokumenupload.edit', compact('dokumenupload'));
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
        
        $dokumenupload = Dokumenupload::findOrFail($id);
        $dokumenupload->update($request->all());

        Session::flash('message', 'Dokumenupload updated!');
        Session::flash('status', 'success');

        return redirect('dokumenupload');
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
        $dokumenupload = Dokumenupload::findOrFail($id);

        $dokumenupload->delete();

        Session::flash('message', 'Dokumenupload deleted!');
        Session::flash('status', 'success');

        return redirect('dokumenupload');
    }

}
