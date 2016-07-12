<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MDb;
use App\Protocol;

class KKController extends Controller
{
  public function index(){
    return view('kk.index');
  }
  public function getList(){
    return Protocol::ajax(function(){
      $ret = array();
      $ret['data'] = MDb::getType('kk');
      $ret['message'] = 'berhasil mengambil data';
      return $ret;
    });
  }
}
