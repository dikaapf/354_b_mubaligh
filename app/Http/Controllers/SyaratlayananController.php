<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Syaratlayanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class SyaratlayananController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $syaratlayanan = Syaratlayanan::all();

        return view('backEnd.syaratlayanan.index', compact('syaratlayanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.syaratlayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Syaratlayanan::create($request->all());

        Session::flash('message', 'Syaratlayanan added!');
        Session::flash('status', 'success');

        return redirect('syaratlayanan');
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
        $syaratlayanan = Syaratlayanan::findOrFail($id);

        return view('backEnd.syaratlayanan.show', compact('syaratlayanan'));
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
        $syaratlayanan = Syaratlayanan::findOrFail($id);

        return view('backEnd.syaratlayanan.edit', compact('syaratlayanan'));
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
        
        $syaratlayanan = Syaratlayanan::findOrFail($id);
        $syaratlayanan->update($request->all());

        Session::flash('message', 'Syaratlayanan updated!');
        Session::flash('status', 'success');

        return redirect('syaratlayanan');
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
        $syaratlayanan = Syaratlayanan::findOrFail($id);

        $syaratlayanan->delete();

        Session::flash('message', 'Syaratlayanan deleted!');
        Session::flash('status', 'success');

        return redirect('syaratlayanan');
    }

}
