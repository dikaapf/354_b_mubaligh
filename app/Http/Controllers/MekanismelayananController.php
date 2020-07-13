<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mekanismelayanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class MekanismelayananController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $mekanismelayanan = Mekanismelayanan::all();

        return view('backEnd.mekanismelayanan.index', compact('mekanismelayanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.mekanismelayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Mekanismelayanan::create($request->all());

        Session::flash('message', 'Mekanismelayanan added!');
        Session::flash('status', 'success');

        return redirect('mekanismelayanan');
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
        $mekanismelayanan = Mekanismelayanan::findOrFail($id);

        return view('backEnd.mekanismelayanan.show', compact('mekanismelayanan'));
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
        $mekanismelayanan = Mekanismelayanan::findOrFail($id);

        return view('backEnd.mekanismelayanan.edit', compact('mekanismelayanan'));
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
        
        $mekanismelayanan = Mekanismelayanan::findOrFail($id);
        $mekanismelayanan->update($request->all());

        Session::flash('message', 'Mekanismelayanan updated!');
        Session::flash('status', 'success');

        return redirect('mekanismelayanan');
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
        $mekanismelayanan = Mekanismelayanan::findOrFail($id);

        $mekanismelayanan->delete();

        Session::flash('message', 'Mekanismelayanan deleted!');
        Session::flash('status', 'success');

        return redirect('mekanismelayanan');
    }

}
