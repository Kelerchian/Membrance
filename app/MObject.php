<?php

namespace App;

use App\MObjectCollection;
use Illuminate\Database\Eloquent\Model;
use App\MDb;

class MObject extends Model
{
  protected $hidden = ['attr'];
  public function newCollection(array $models = [])
  {
      return new MObjectCollection($models);
  }

  public function attr(){
    return $this->hasMany('App\MAttribute');
  }
  public function getData(){
    MDb::getData($this);
  }
  public function json(){
    return json_encode($this);
  }
}
