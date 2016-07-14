<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MDb;
use App\Http\Requests;
use App\Protocol;

class TemplateController extends Controller
{
  public function index(){
    $kkTemplate = MDb::getFirstTypeName('template','kk');
    if($kkTemplate == null){
        $kkTemplate = array();
    }
    else{
        $kkTemplate = $kkTemplate->data->template;
    }
    $pendudukTemplate = MDb::getFirstTypeName('template','penduduk');
    if($pendudukTemplate == null){
      $pendudukTemplate = array();
    }else{
      $pendudukTemplate = $pendudukTemplate->data->template;
    }
    return view('template.index',[
      'kkTemplate'=>$kkTemplate,
      'pendudukTemplate'=>$pendudukTemplate
    ]);
  }
  public function storeKK(Request $request){
    $data = json_decode($request->data);
    return Protocol::transaction(function()use($data){
      $ret = array();
      $oldTemplate = MDb::getFirstTypeName('template','kk');
      $kkTemplate = new \StdClass();
      if($oldTemplate){
        $kkTemplate->id = $oldTemplate->id;
      }
      $kkTemplate->type = 'template';
      $kkTemplate->name = 'kk';
      $kkTemplate->data = $data;
      MDB::editOrInsert($kkTemplate);
      $ret['message'] = 'Berhasil mengubah template kartu keluarga.';
      return $ret;
    });
  }
  public function storePenduduk(Request $request){
    $data = json_decode($request->data);
    return Protocol::transaction(function()use($data){
      $ret = array();
      $oldTemplate = MDb::getFirstTypeName('template','penduduk');
      $pendudukTemplate = new \StdClass();
      if($oldTemplate){
        $pendudukTemplate->id = $oldTemplate->id;
      }
      $pendudukTemplate->type = 'template';
      $pendudukTemplate->name = 'penduduk';
      $pendudukTemplate->data = $data;
      MDB::editOrInsert($pendudukTemplate);
      $ret['message'] = 'Berhasil mengubah template penduduk.';
      return $ret;
    });
  }
}
