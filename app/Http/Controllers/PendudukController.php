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
    public function getList(Request $request){
      $input = $request->all();
      $query = json_decode($request['query']);
      return Protocol::ajax(function()use($query){
        $ret = array();
        $ret['query'] = $query;
        $ret['data'] = MDb::getTypeWhere('penduduk',$query);
        $ret['message'] = 'Berhasil mengambil data penduduk';
        return $ret;
      });
    }
    public function jumpKK($id){
      $penduduk = MDB::getFirstTypeId('penduduk',$id);
      if($penduduk == null){
        return redirect(route('penduduk.index'))->with([
          'errors'=>['Halaman yang anda cari tidak ditemukan']
        ]);
      }
      $kk = MDb::getFroms('kk-penduduk',$id);
      if(!isset($kk[0])){
        return redirect(route('penduduk.index'))->with([
          'errors'=>['Halaman yang anda cari tidak ditemukan']
        ]);
      }else{
        $kk = $kk[0];
      }
      return redirect(route('kk.edit',$kk->id));
    }
}
