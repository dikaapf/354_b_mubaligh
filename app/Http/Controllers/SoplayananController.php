<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Soplayanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class SoplayananController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $soplayanan = Soplayanan::all();

        return view('backEnd.soplayanan.index', compact('soplayanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.soplayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Soplayanan::create($request->all());

        Session::flash('message', 'Soplayanan added!');
        Session::flash('status', 'success');

        return redirect('soplayanan');
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
        $soplayanan = Soplayanan::findOrFail($id);

        return view('backEnd.soplayanan.show', compact('soplayanan'));
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
        $soplayanan = Soplayanan::findOrFail($id);

        return view('backEnd.soplayanan.edit', compact('soplayanan'));
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
        
        $soplayanan = Soplayanan::findOrFail($id);
        $soplayanan->update($request->all());

        Session::flash('message', 'Soplayanan updated!');
        Session::flash('status', 'success');

        return redirect('soplayanan');
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
        $soplayanan = Soplayanan::findOrFail($id);

        $soplayanan->delete();

        Session::flash('message', 'Soplayanan deleted!');
        Session::flash('status', 'success');

        return redirect('soplayanan');
    }

}
