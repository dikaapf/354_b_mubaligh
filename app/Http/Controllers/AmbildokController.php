<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ambildok;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class AmbildokController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ambildok = Ambildok::all();

        return view('backEnd.ambildok.index', compact('ambildok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.ambildok.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Ambildok::create($request->all());

        Session::flash('message', 'Ambildok added!');
        Session::flash('status', 'success');

        return redirect('ambildok');
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
        $ambildok = Ambildok::findOrFail($id);

        return view('backEnd.ambildok.show', compact('ambildok'));
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
        $ambildok = Ambildok::findOrFail($id);

        return view('backEnd.ambildok.edit', compact('ambildok'));
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
        
        $ambildok = Ambildok::findOrFail($id);
        $ambildok->update($request->all());

        Session::flash('message', 'Ambildok updated!');
        Session::flash('status', 'success');

        return redirect('ambildok');
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
        $ambildok = Ambildok::findOrFail($id);

        $ambildok->delete();

        Session::flash('message', 'Ambildok deleted!');
        Session::flash('status', 'success');

        return redirect('ambildok');
    }

}
