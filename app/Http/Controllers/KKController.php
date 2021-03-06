<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MDb;
use App\Protocol;

class KKController extends Controller
{
  public function index(){
    $kkTemplate = MDb::getFirstTypeName('template','kk');
    if($kkTemplate == null){
        $kkTemplate = array();
    }
    else{
        $kkTemplate = $kkTemplate->data->template;
    }
    return view('kk.index',[
      'kkTemplate'=>$kkTemplate
    ]);
  }
  public function getList(Request $request){
    $input = $request->all();
    $query = json_decode($request['query']);
    return Protocol::ajax(function()use($query){
      $ret = array();
      $ret['data'] = MDb::getTypeWhere('kk',$query);
      $ret['message'] = 'Berhasil mengambil data kartu keluarga';
      return $ret;
    });
  }
  public function edit($id){
    $kk = MDb::getFirstTypeId('kk',$id);
    if($kk == null){
      return redirect(route('kk.index'))->with([
        'errors'=>['Halaman yang anda cari tidak ditemukan']
      ]);
    }
    $penduduk = MDb::getTos('kk-penduduk',$id);

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

    return view ('kk.edit',[
      'kk'=>$kk,
      'penduduk'=>$penduduk,
      'kkTemplate'=>$kkTemplate,
      'pendudukTemplate'=>$pendudukTemplate
    ]);
  }
  public function update(Request $request, $id){
    $input = $request->input();
    $kkData = json_decode($input['kk']);

    $kk = MDb::getFirstTypeId('kk',$id);
    if($kk == null){
      throw new \Exception('Halaman yang anda cari tidak ditemukan');
    }
    $kk->data = $kkData->data;
    $penduduk = json_decode($input['penduduk']);
    return Protocol::transaction(function()use($kk,$penduduk){
      $data = array();
      foreach ($penduduk as $key => $value) {
        $penduduk[$key]->type='penduduk';
      }
      MDb::edit($kk);
      MDb::updateTos('kk-penduduk',$kk,$penduduk);
      $data['message'] = "Kartu Keluarga telah diperbarui";
      return $data;
    });
  }
  public function add(Request $request){
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

    return view('kk.add',[
      'kkTemplate'=>$kkTemplate,
      'pendudukTemplate'=>$pendudukTemplate
    ]);
  }
  public function store(Request $request){
    $input = $request->input();
    $kk = json_decode($input['kk']);
    $penduduk = json_decode($input['penduduk']);
    return Protocol::transaction(function()use($kk,$penduduk){
      $data = array();
      if(MDB::getFirstTypeName('kk',$kk->name)!=null){
        throw new \Exception('Sudah ada kartu keluarga dengan nomor: '.$kk->name);
      }
      $idKK=MDB::insert('kk',$kk->name,$kk->data);
      if(count($penduduk) == 0){
        throw new \Exception('Anggota Keluarga masih kosong');
      }
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
  public function deleteKK(Request $request, $id){
    return Protocol::transaction(function()use($id){
      $kk = MDb::getFirstTypeId('kk',$id);
      if($kk == null){
        throw new \Exception('Halaman yang anda cari tidak ditemukan');
      }
      $penduduk = MDb::getTos('kk-penduduk',$id);
      foreach ($penduduk as $sPenduduk) {
        MDb::remove($sPenduduk->id);
      }
      MDb::remove($kk->id);
      MDb::purgeRelationFrom('kk-penduduk',$kk->id);
      $ret = array();
      $ret['message'] = 'berhasil menghapus kk dengan nomor:'.$kk->name;
      return $ret;
    });
  }
}
