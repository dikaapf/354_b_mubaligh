<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class OperatorLoginController extends Controller {

    public function __construct() {
        $this->middleware('guest:pengajar', [
            'except' => [
                'logout',
        ]]);
    }

    public function showLoginForm() {
        return view('auth.pengajar-login');
    }

    public function login(Request $request) {
        // Validate the form data
        $this->validate($request, [
//            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if (Auth::guard('pengajar')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('pengajar.dashboard'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout() {
        Auth::guard('pengajar')->logout();
        return redirect('../');
    }

}
