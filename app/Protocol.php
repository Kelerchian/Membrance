<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Protocol extends Model
{
    public static function ajax($func){
      $ret = array();
      try{
        $data = $func();
        foreach($data as $key=>$value){
          $ret[$key] = $data[$key];
        }
        $ret['status'] = 1;
      }catch(\Exception $e){
        $ret['message'] = $e->getMessage();
        $ret['status'] = 0;
      }
      return json_encode($ret);
    }
    public static function transaction($func){
      $ret = array();
      try{
        DB::beginTransaction();
        $data = $func();
        foreach($data as $key=>$value){
          $ret[$key] = $data[$key];
        }
        $ret['status'] = 1;
        DB::commit();
      }catch(\Exception $e){
        DB::rollBack();
        $ret['stackTrace'] = $e->getTraceAsString();
        $ret['message'] = $e->getMessage().' in '.$e->getFile().' at line '.$e->getLine();
        $ret['status'] = 0;
      }
      return json_encode($ret);
    }
}
