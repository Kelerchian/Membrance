<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MDb;
use App\Protocol;

class PendudukController extends Controller
{
    public function index(){
        return view('penduduk.index');
    }
}
