<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
//                    'name' => 'required|string|max:255',
//                    'email' => 'required|string|email|max:255|unique:users',
//                    'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {

//        return $data;
//        return Input::all();
//        if (Input::hasfile('link_ktp') && Input::hasfile('link_kk') && Input::hasfile('link_ttd') && Input::hasfile('link_selfie')) {

        $filektp = $data['email'] . "_" . str_replace(" ", "_", Input::file('link_ktp')->getClientOriginalName());
        $filekk = $data['email'] . "_" . str_replace(" ", "_", Input::file('link_kk')->getClientOriginalName());
        $filettd = $data['email'] . "_" . str_replace(" ", "_", Input::file('link_ttd')->getClientOriginalName());
        $fileselfie = $data['email'] . "_" . str_replace(" ", "_", Input::file('link_selfie')->getClientOriginalName());
        $extktp = Input::file('link_ktp')->getClientOriginalExtension();
        $extkk = Input::file('link_kk')->getClientOriginalExtension();
        $extttd = Input::file('link_ttd')->getClientOriginalExtension();
        $extselfie = Input::file('link_selfie')->getClientOriginalExtension();
        if ($extktp == 'JPG' || $extktp == 'jpg' || $extktp == 'png') {
            Input::file('link_ktp')->move(public_path('/files/user/ktp'), $filektp);
        }

        if ($extkk == 'JPG' || $extkk == 'jpg' || $extkk == 'png') {
            Input::file('link_kk')->move(public_path('/files/user/kk'), $filekk);
        }

        if ($extttd == 'JPG' || $extttd == 'jpg' || $extttd == 'png') {
            Input::file('link_ttd')->move(public_path('/files/user/ttd'), $filettd);
        }

        if ($extselfie == 'JPG' || $extselfie == 'jpg' || $extselfie == 'png') {
            Input::file('link_selfie')->move(public_path('/files/user/selfie'), $fileselfie);
        }
        if (Input::hasfile('link_ktp') && Input::hasfile('link_kk') && Input::hasfile('link_ttd') && Input::hasfile('link_selfie')) {
            return User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
                        'no_kk' => $data['no_kk'],
                        'no_hp' => $data['no_hp'],
                        'alamat' => $data['alamat'],
                        'link_ktp' => '/files/user/ktp/' . $filektp,
                        'link_kk' => '/files/user/kk/' . $filekk,
                        'link_ttd' => '/files/user/ttd/' . $filettd,
                        'link_selfie' => '/files/user/selfie/' . $fileselfie,
                        'alamat_email' => $data['alamat_email'],
            ]);
        }


//        }
    }

}
