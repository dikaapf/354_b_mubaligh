<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller {

    public function __construct() {
//        $this->middleware('auth:admin');
        $this->middleware('auth:admin', [
            'except' => [
//                'destroy',
        ]]);
    }

    public function index() {
//        return 0;
        return view('admin.home');
    }

    public function indexuser() {
        $data['pengguna'] = \App\User::all();

        return view('backEnd.pengguna.index', $data);
    }

    public function create() {
        $data['list_opd'] = $this->listOpd();
        return view('backEnd.admin.create', $data);
    }

    public function store(Request $request) {
//        return Input::all();
        $this->validate($request, ['password' => 'required',]);
        $data = array(
            'nama' => Input::get('nama'),
            'nip' => bersihkan(Input::get('nip')),
            'password' => bcrypt(Input::get('password')),
            'admin_level' => Input::get('admin_level'),
            'opd_id' => Input::get('opd_id'),
        );
        Admin::create($data);

        Session::flash('message', 'Admin added!');
        Session::flash('status', 'success');

        return redirect('adminopd');
    }

    public function show($id) {
        $admin = Admin::findOrFail($id);

        return view('backEnd.admin.show', compact('admin'));
    }

    public function edit($id) {
        $data['list_opd'] = $this->listOpd();
        $data['admin'] = Admin::findOrFail($id);

        return view('backEnd.admin.edit', $data);
    }

    public function update($id, Request $request) {
//        $this->validate($request, ['password' => 'required',]);

        $admin = Admin::findOrFail($id);
        $admin->update($request->all());

        Session::flash('message', 'Admin updated!');
        Session::flash('status', 'success');

        return redirect('adminopd');
    }

    public function destroy($id) {
        $admin = Admin::find($id);

        $admin->delete();

        Session::flash('message', 'Admin deleted!');
        Session::flash('status', 'success');

        return redirect('adminopd');
    }

}
