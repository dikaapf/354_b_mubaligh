<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Statuspengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class StatuspengajuanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $statuspengajuan = Statuspengajuan::all();

        return view('backEnd.statuspengajuan.index', compact('statuspengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.statuspengajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Statuspengajuan::create($request->all());

        Session::flash('message', 'Statuspengajuan added!');
        Session::flash('status', 'success');

        return redirect('statuspengajuan');
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
        $statuspengajuan = Statuspengajuan::findOrFail($id);

        return view('backEnd.statuspengajuan.show', compact('statuspengajuan'));
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
        $statuspengajuan = Statuspengajuan::findOrFail($id);

        return view('backEnd.statuspengajuan.edit', compact('statuspengajuan'));
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
        
        $statuspengajuan = Statuspengajuan::findOrFail($id);
        $statuspengajuan->update($request->all());

        Session::flash('message', 'Statuspengajuan updated!');
        Session::flash('status', 'success');

        return redirect('statuspengajuan');
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
        $statuspengajuan = Statuspengajuan::findOrFail($id);

        $statuspengajuan->delete();

        Session::flash('message', 'Statuspengajuan deleted!');
        Session::flash('status', 'success');

        return redirect('statuspengajuan');
    }

}
