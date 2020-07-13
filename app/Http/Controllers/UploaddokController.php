<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Uploaddok;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class UploaddokController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $uploaddok = Uploaddok::all();

        return view('backEnd.uploaddok.index', compact('uploaddok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.uploaddok.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Uploaddok::create($request->all());

        Session::flash('message', 'Uploaddok added!');
        Session::flash('status', 'success');

        return redirect('uploaddok');
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
        $uploaddok = Uploaddok::findOrFail($id);

        return view('backEnd.uploaddok.show', compact('uploaddok'));
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
        $uploaddok = Uploaddok::findOrFail($id);

        return view('backEnd.uploaddok.edit', compact('uploaddok'));
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
        
        $uploaddok = Uploaddok::findOrFail($id);
        $uploaddok->update($request->all());

        Session::flash('message', 'Uploaddok updated!');
        Session::flash('status', 'success');

        return redirect('uploaddok');
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
        $uploaddok = Uploaddok::findOrFail($id);

        $uploaddok->delete();

        Session::flash('message', 'Uploaddok deleted!');
        Session::flash('status', 'success');

        return redirect('uploaddok');
    }

}
