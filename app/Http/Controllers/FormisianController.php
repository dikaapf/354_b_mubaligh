<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Formisian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class FormisianController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formisian = Formisian::all();

        return view('backEnd.formisian.index', compact('formisian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.formisian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Formisian::create($request->all());

        Session::flash('message', 'Formisian added!');
        Session::flash('status', 'success');

        return redirect('formisian');
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
        $formisian = Formisian::findOrFail($id);

        return view('backEnd.formisian.show', compact('formisian'));
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
        $formisian = Formisian::findOrFail($id);

        return view('backEnd.formisian.edit', compact('formisian'));
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
        
        $formisian = Formisian::findOrFail($id);
        $formisian->update($request->all());

        Session::flash('message', 'Formisian updated!');
        Session::flash('status', 'success');

        return redirect('formisian');
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
        $formisian = Formisian::findOrFail($id);

        $formisian->delete();

        Session::flash('message', 'Formisian deleted!');
        Session::flash('status', 'success');

        return redirect('formisian');
    }

}
