<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRelation extends Model
{
    public function tos(){
      return $this->hasMany('App\MObject','id','to');
    }
    public function froms(){
      return $this->hasMany('App\MObject','id','from');
    }
}
