<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditorController extends Controller
{
    function auditor(){
       
        return view('auditor.index');
    }
}
