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
  public function add(Request $request){
    return view('kk.add');
  }
  public function store(Request $request){
    $input = $request->input();
    $kk = json_decode($input['kk']);
    $penduduk = json_decode($input['penduduk']);
    return Protocol::transaction(function()use($kk,$penduduk){
      $data = array();
      if(MDB::getFirstTypeName('kk',$kk->name)!=null){
        throw new \Exception('Sudah ada kartu keluarga dengan nomor: '.$kk->nomor_kartu_keluarga);
      }
      $idKK=MDB::insert('kk',$kk->name,$kk->data);
      foreach($penduduk as $person){
        $pName = $person->name;
        $pData = $person->data;
        $idPenduduk = MDB::insert('penduduk',$pName,$pData);
        MDb::createRelation('kk-penduduk',$idKK,$idPenduduk);
      }
      $data['message'] = 'Berhasil mendaftarkan kartu keluarga.';
      return $data;
    });
  }
}
