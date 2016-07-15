<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MDb;
use App\Protocol;

class PendudukController extends Controller
{
    public function index(){
        $pendudukTemplate = MDb::getFirstTypeName('template','penduduk');
        if($pendudukTemplate == null){
            $pendudukTemplate = array();
        }
        else{
            $pendudukTemplate = $pendudukTemplate->data->template;
        }
        return view('penduduk.index',[
          'pendudukTemplate'=>$pendudukTemplate
        ]);
    }
}
