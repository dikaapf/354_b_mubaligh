<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class FrontController extends Controller {

    public function get_agregat() {
//        return Input::all();
        $r = DB::connection('oracle1')->table('BIODATA_WNI_201602')
                ->select(DB::raw('getnamakec(no_kec,no_kab,no_prop) nama_kec,
                                count(*)jum_duk'
                        ))
                ->where('no_prop', '=', 91)
                ->where('no_kab', '=', 2)
                ->groupBy('no_prop')
                ->groupBy('no_kab')
                ->groupBy('no_kec')
                ->orderBy('no_kec', 'asc')
                ->get();
        return json_encode($r);
    }

}
