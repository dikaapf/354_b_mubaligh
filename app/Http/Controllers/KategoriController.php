<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Kategori;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class KategoriController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $kategori = Kategori::all();

        return view('backEnd.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Kategori::create($request->all());

        Session::flash('message', 'Kategori added!');
        Session::flash('status', 'success');

        return redirect('kategori');
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
        $kategori = Kategori::findOrFail($id);

        return view('backEnd.kategori.show', compact('kategori'));
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
        $kategori = Kategori::findOrFail($id);

        return view('backEnd.kategori.edit', compact('kategori'));
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
        
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        Session::flash('message', 'Kategori updated!');
        Session::flash('status', 'success');

        return redirect('kategori');
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
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        Session::flash('message', 'Kategori deleted!');
        Session::flash('status', 'success');

        return redirect('kategori');
    }

}
