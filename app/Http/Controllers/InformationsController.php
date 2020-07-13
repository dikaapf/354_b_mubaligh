<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Information;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class InformationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $informations = Information::all();

        return view('backEnd.informations.index', compact('informations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.informations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Information::create($request->all());

        Session::flash('message', 'Information added!');
        Session::flash('status', 'success');

        return redirect('informations');
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
        $information = Information::findOrFail($id);

        return view('backEnd.informations.show', compact('information'));
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
        $information = Information::findOrFail($id);

        return view('backEnd.informations.edit', compact('information'));
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
        
        $information = Information::findOrFail($id);
        $information->update($request->all());

        Session::flash('message', 'Information updated!');
        Session::flash('status', 'success');

        return redirect('informations');
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
        $information = Information::findOrFail($id);

        $information->delete();

        Session::flash('message', 'Information deleted!');
        Session::flash('status', 'success');

        return redirect('informations');
    }

}
