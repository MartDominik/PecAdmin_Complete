<?php

namespace App\Http\Controllers;

use App\Models\hirdetes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PecAdminController extends Controller
{

    public function Main(){
        return view('Main');
    }
    public function szervezoinknek(){

        return view('szervezoinknek');
    }
    public function rolunk(){

        return view('rolunk');
    }
    public function kapcsolat(){

        return view('kapcsolat');
    }


}
