<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MAttribute extends Model
{
  public function parent(){
    return $this->belongsTo('App\MObject');
  }
}
