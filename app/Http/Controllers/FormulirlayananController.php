<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Formulirlayanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class FormulirlayananController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formulirlayanan = Formulirlayanan::all();

        return view('backEnd.formulirlayanan.index', compact('formulirlayanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.formulirlayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Formulirlayanan::create($request->all());

        Session::flash('message', 'Formulirlayanan added!');
        Session::flash('status', 'success');

        return redirect('formulirlayanan');
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
        $formulirlayanan = Formulirlayanan::findOrFail($id);

        return view('backEnd.formulirlayanan.show', compact('formulirlayanan'));
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
        $formulirlayanan = Formulirlayanan::findOrFail($id);

        return view('backEnd.formulirlayanan.edit', compact('formulirlayanan'));
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
        
        $formulirlayanan = Formulirlayanan::findOrFail($id);
        $formulirlayanan->update($request->all());

        Session::flash('message', 'Formulirlayanan updated!');
        Session::flash('status', 'success');

        return redirect('formulirlayanan');
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
        $formulirlayanan = Formulirlayanan::findOrFail($id);

        $formulirlayanan->delete();

        Session::flash('message', 'Formulirlayanan deleted!');
        Session::flash('status', 'success');

        return redirect('formulirlayanan');
    }

}
