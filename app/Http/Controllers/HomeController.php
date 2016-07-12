<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\MObject;
use App\MAttribute;
use App\MDb;

class HomeController extends Controller
{
    public function storetest(Request $request){
      $input = $request->input();

      $type = $input['type'];
      $name = $input['name'];
      $prop = $input['prop'];
      $status = MDb::insert($type ,$name ,$prop);

      $status = 1;
    }

    public function gettest(){
      $whereClauses = array();
      $whereClauses[] = ['tanggal lahir','>=','2312-12-31'];
      $ret = MDb::getTypeWhere('primer',$whereClauses);
      echo "<pre>".json_encode($ret,JSON_PRETTY_PRINT)."</pre>";
      dd($ret);
    }
}
