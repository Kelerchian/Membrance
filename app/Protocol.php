<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
