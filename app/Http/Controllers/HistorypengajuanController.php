<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Historypengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class HistorypengajuanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $historypengajuan = Historypengajuan::all();

        return view('backEnd.historypengajuan.index', compact('historypengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.historypengajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Historypengajuan::create($request->all());

        Session::flash('message', 'Historypengajuan added!');
        Session::flash('status', 'success');

        return redirect('historypengajuan');
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
        $historypengajuan = Historypengajuan::findOrFail($id);

        return view('backEnd.historypengajuan.show', compact('historypengajuan'));
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
        $historypengajuan = Historypengajuan::findOrFail($id);

        return view('backEnd.historypengajuan.edit', compact('historypengajuan'));
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
        
        $historypengajuan = Historypengajuan::findOrFail($id);
        $historypengajuan->update($request->all());

        Session::flash('message', 'Historypengajuan updated!');
        Session::flash('status', 'success');

        return redirect('historypengajuan');
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
        $historypengajuan = Historypengajuan::findOrFail($id);

        $historypengajuan->delete();

        Session::flash('message', 'Historypengajuan deleted!');
        Session::flash('status', 'success');

        return redirect('historypengajuan');
    }

}
