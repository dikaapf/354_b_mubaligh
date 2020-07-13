<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Riwayatprose;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RiwayatprosesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $riwayatproses = Riwayatprose::all();

        return view('backEnd.riwayatproses.index', compact('riwayatproses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.riwayatproses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Riwayatprose::create($request->all());

        Session::flash('message', 'Riwayatprose added!');
        Session::flash('status', 'success');

        return redirect('riwayatproses');
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
        $riwayatprose = Riwayatprose::findOrFail($id);

        return view('backEnd.riwayatproses.show', compact('riwayatprose'));
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
        $riwayatprose = Riwayatprose::findOrFail($id);

        return view('backEnd.riwayatproses.edit', compact('riwayatprose'));
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
        
        $riwayatprose = Riwayatprose::findOrFail($id);
        $riwayatprose->update($request->all());

        Session::flash('message', 'Riwayatprose updated!');
        Session::flash('status', 'success');

        return redirect('riwayatproses');
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
        $riwayatprose = Riwayatprose::findOrFail($id);

        $riwayatprose->delete();

        Session::flash('message', 'Riwayatprose deleted!');
        Session::flash('status', 'success');

        return redirect('riwayatproses');
    }

}
