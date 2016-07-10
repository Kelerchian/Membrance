<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MDb;

class MObject extends Model
{
  protected $hidden = ['attr'];
  public function attr(){
    return $this->hasMany('App\MAttribute');
  }
  public function where(&$whereClause){
    return MDb::where($this,$whereClause);
  }
}
