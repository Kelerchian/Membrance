<?php

namespace App;

use Illuminate\Support\Collection;
use App\MDb;

class MObjectCollection extends Collection
{

  public function where($key,$value = true,$strict = true){
    return MDb::where($this,$key);
  }
  public function getData(){
    MDb::getData($this);
  }
  public function json(){
    return json_encode($this);
  }
}
