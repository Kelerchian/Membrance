<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use MDb;

class KKController extends Controller
{
  public function index(){
    return view('kk.index');
  }
}
