<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MObjectCollection;
use App\MAttribute;
use App\MObject;
use App\MRelation;
use DB;
class MDb extends Model
{
    private static $debugMode = true;
    private static function debug($string){
      if(MDb::$debugMode){
        echo "<pre>";
        echo $string;
        echo "</pre>";
      }
    }
    public static function escape($string){
      $ret = DB::connection()->getPdo()->quote($string);
      return substr($ret,1,strlen($ret)-2);
    }
    private static function mJoin(&$object){
      foreach($object as $key=>$val){
        $object[$key] = MDb::mSingleJoin($object[$key]);
      }
      return $object;
    }
    private static function joinAttribute(&$single,$dataAttrs){
      $dataString = '';
      foreach($dataAttrs as $dataKey=>$dataVal){
        $dataString.=$dataAttrs[$dataKey]->data;
      }
      return $dataString;
    }
    private static function mSingleJoin(&$single){
      if($single == null){
        return null;
      }
      $dataString = MDb::joinAttribute($single,$single->attr);
      $single->data = json_decode($dataString);
      return $single;
    }

    //WHERE MAKER
    /*
    private static function makeSingleWhere(&$query,&$singleWhere){
      $binary = 'and';
      $attribute = '';
      $relation = '=';
      $value = '';
      if(count($singleWhere)==4){
        $binary = $singleWhere[0];
        $attribute = $singleWhere[1];
        $relation = $singleWhere[2];
        $value = $singleWhere[3];
      }
      if(count($singleWhere)==3){
        $attribute = $singleWhere[0];
        $relation = $singleWhere[1];
        $value = $singleWhere[2];
      }
      if(count($singleWhere)==2){
        $attribute = $singleWhere[0];
        $value = $singleWhere[1];
      }


      $whereClause = '';
      if($relation=='=' || trim(strtolower($relation))=='is' ){
        $whereClause = '%"'.MDb::escape($attribute).'":"'.MDb::escape($value).'"%';
      }
      else{
      $whereClause = '%"'.MDb::escape($attribute).'":"%'.MDb::escape($value).'%"%';
      }
      if(trim(strtolower($binary))=='or'){
        $query->orWhere('data','like',$whereClause);
      }else{
        $query->where('data','like',$whereClause);
      }
    }
    private static function makeWhere(&$query,&$where){
      foreach($where as $key=>$val){
        MDb::makeSingleWhere($query,$where[$key]);
      }
    }
    */
    public static function getTos($name,$from){
      $ret = MRelation::with('tos.attr')->where('name',$name)->where('from',$from)->get();
      return MDb::mJoin($ret[0]->tos);
    }
    public static function purgeRelation($name,$from,$to){
      MRelation::where('name',$name)->where('from',$from)->where('to',$to)->delete();
      return true;
    }
    public static function purgeRelationFrom($name,$from){
      MRelation::where('name',$name)->where('from',$from)->delete();
      return true;
    }
    public static function purgeRelationTo($name,$to){
      MRelation::where('name',$name)->where('to',$to)->delete();
      return true;
    }
    public static function createRelation($name,$from,$to){
      $relation = new MRelation();
      $relation->name = $name;
      $relation->to = $to;
      $relation->from = $from;
      $relation->save();
      return $relation->id;
    }

    //GETTER
    public static function get(){
      $ret = MObject::with('attr')->get();
      return MDb::mJoin($ret);
    }
    public static function getType($type){
      $ret = MObject::with('attr')->where('type',$type)->get();
      return MDb::mJoin($ret);
    }
    public static function getName($name){
      $ret = MDb::with('attr')->where('name',$name)->get();
      return MDb::mJoin($ret);
    }
    public static function getTypeName($type,$name){
      $ret = MObject::with('attr')->where('type',$type)->where('name',$name)->get();
      return MDb::mJoin($ret);
    }
    public static function getWhere($whereClauses){
      $ret = MDb::get();
      return MDb::where($ret,$whereClauses);
    }
    public static function getTypeWhere($type,$whereClauses){
      $ret = MDb::getType($type);
      return MDb::where($ret,$whereClauses);
    }
    public static function getFirstById($id){
      $ret = MObject::with('attr')->where('id',$id)->first();
      return MDb::mSingleJoin($ret);
    }
    public static function getFirstTypeName($type,$name){
      $ret = MObject::with('attr')->where('type',$type)->where('name',$name)->first();
      return MDb::mSingleJoin($ret);
    }
    private static function getSingleData(&$object){
      $ret = MAttribute::selectRaw("GROUP_CONCAT(data SEPARATOR '') as data")->where('m_object_id',$object->id)->first();
      $object->data = json_decode($ret->data);
      return $object;
    }
    public static function getData(&$object){
      if(isset($object->name)){
        return MDb::getSingleData($object);
      }
      foreach ($object as $key => $value) {
        $object[$key] = MDb::getSingleData($object[$key]);
      }
      return $object;
    }
    /*
    public static function getFirstWhere($where){
      $ret = MObject::whereHas('attr',function($query) use (&$where){
        MDb::makeWhere($query,$where);
      })->with('attr')->first();
    }
    */
    public static function getFirstType($where){
      $ret = MObject::where('type',$type)->with('attr')->first();
      return MDb::mJoin($ret);
    }
    /*
    public static function getFirstTypeWhere($type,$where){
      $ret = MObject::where('type',$type)->whereHas('attr',function($query) use (&$where){
        MDb::makeWhere($query,$where);
      })->with('attr')->first();
    }
    */
    private static function removeBulk($ids){
      $qO=MObject::orWhere('1','=','1');
      $qA=MAttribute::orWhere('1','=','1');
      foreach($ids as $id){
        $qO->orWhere('id',$id);
        $qA->orWhere('m_object_id',$id);
      }
      $qO->delete();
      $qA->delete();
      return true;
    }
    private static function removeAttr($id){
      try{
        MAttribute::where('m_object_id',$id)->delete();
        return true;
      }catch(\Exception $e){
        throw $e;
      }
    }
    public static function remove($id){
      try{

        MDb::removeAttr($id);
        MObject::where('id',$id)->delete();
        return true;
      }catch(\Exception $e){

        throw $e;
      }
    }
    public static function removeWhere($whereClauses){
      try{


        $objects = MDb::getWhere($whereClauses);
        $ids = array();
        foreach($objects as $object){
          $ids[] = $object->id;
        }
        MDb::removeBulk($ids);

        return true;
      }catch(\Exception $e){

        throw $e;
      }
    }

    private static function insertAttr($id,$data){
      try{
        $dataArray = array();
        $start = 0;
        $end = 0;
        while(true){
          $end = $start + 255;
          if($end>strlen($data)){
            $end = strlen($data);
          }

          $mAttribute = new MAttribute();
          $mAttribute->m_object_id = $id;
          $mAttribute->data = substr($data,$start,$end-$start);
          $mAttribute->save();

          $start = $end;
          if($start>=strlen($data)){
            break;
          }
        }
        return true;
      }catch(\Exception $e){
        throw $e;
      }
    }
    public static function insertObject(&$object){
      try{
          $name = $object->name;
          $type = $object->type;
          $data = $object->data;
          return MDB::insert($type,$name,$data);
      }catch(\Exception $e){
          throw $e;
      }
    }
    public static function insert($type, &$name, &$data){
        try{

            if($name == null){
                throw new \Exception('Name is empty');
            }
            if($type == null){
                throw new \Exception('type is empty');
            }
            if($data == null){
                throw new \Exception('Data is empty');
            }
            $mObject = new MObject;
            $mObject->name = $name;
            $mObject->type = $type;
            $mObject->save();

            $id = $mObject->id;
            MDb::insertAttr($id,json_encode($data));
            return $id;
        }catch(\Exception $e){

            throw $e;
        }
    }
    public static function edit(&$object){
        try{

            $name = $object->name;
            $type = $object->type;
            $data = $object->data;
            if($name == null){
                throw new \Exception('Name is empty');
            }
            if($type == null){
                throw new \Exception('type is empty');
            }
            if($data == null){
                throw new \Exception('Data is empty');
            }
            $mObject = MObject::find($object->id);
            $mObject->name = $name;
            $mObject->type = $type;
            $mObject->save();

            MDb::removeAttr($mObject->id);
            MDb::insertAttr($id,json_encode($data));
            return true;
        }catch(\Exception $e){

            throw $e;
        }
    }

    private static function makeWhere(&$singleWhere){
      if(count($singleWhere)<2){
        return false;
      }

      $whereObj = new \StdClass();
      $whereObj->and = true;
      $whereObj->attribute = '';
      $whereObj->relation = '=';
      $whereObj->value = '';

      if(count($singleWhere)==4){
        $whereObj->and = trim(strtolower($singleWhere[0])) == 'and' ? true:false;
        $whereObj->attribute = $singleWhere[1];
        $whereObj->relation = $singleWhere[2];
        $whereObj->value = $singleWhere[3];
      }
      else if(count($singleWhere)==3){
        $whereObj->attribute = $singleWhere[0];
        $whereObj->relation = $singleWhere[1];
        $whereObj->value = $singleWhere[2];
      }
      else if(count($singleWhere)==2){
        $whereObj->attribute = $singleWhere[0];
        $whereObj->value = $singleWhere[1];
      }

      if(trim($whereObj->attribute)=='' || trim($whereObj->value)==''){
        return false;
      }

      return $whereObj;
    }
    private static function evaluateWhere(&$object, &$whereObj){
      if($whereObj->attribute == 'name' || $whereObj->attribute == 'type' || $whereObj->attribute == 'id'){
        $comparable = $object;
      }else{
        $comparable = $object->data;
      }
      if(!isset($comparable->{$whereObj->attribute})){
        return false;
      }
      if($whereObj->relation == '=' || $whereObj->relation == '=='){
        return $comparable->{$whereObj->attribute}==$whereObj->value;
      }
      else if($whereObj->relation == '<'){
        return $comparable->{$whereObj->attribute}<$whereObj->value;
      }
      else if($whereObj->relation == '<=' || $whereObj->relation == '=<'){
        return $comparable->{$whereObj->attribute}<=$whereObj->value;
      }
      else if($whereObj->relation == '>=' || $whereObj->relation == '=>'){
        return $comparable->{$whereObj->attribute}>=$whereObj->value;
      }
      else if($whereObj->relation == '>'){
        return $comparable->{$whereObj->attribute}>$whereObj->value;
      }
      else if($whereObj->relation == '!=' || $whereObj->relation == '<>'){
        return $comparable->{$whereObj->attribute}!=$whereObj->value;
      }
      else if($whereObj->relation == 'like' || $whereObj->relation == 'like'){
        return strpos($comparable->{$whereObj->attribute},$whereObj->value)!==false;
      }
    }
    private static function singleWhere(&$object, &$whereClauses){
      if(count($whereClauses)==0){
        return true;
      }
      $trueCount = 0;
      $falseCount = 0;
      foreach($whereClauses as $key=>$value){
        $whereObj = MDb::makeWhere($whereClauses[$key]);
        if($whereObj === false){
          continue;
        }
        if(MDb::evaluateWhere($object,$whereObj)){
          $trueCount++;
        }else{
          if($whereObj->and){
            return false;
          }
          $falseCount++;
        }
      }
      return !($trueCount==0 && $falseCount>0);
    }
    public static function where(&$objects, &$whereClause){
      if(isset($objects->data)){
        return MDb::singleWhere($objects, $whereClause);
      }
      else{
        $newCollection = new MObjectCollection();
        foreach($objects as $key=>$value){
          if(MDb::singleWhere($objects[$key], $whereClause)){
            $newCollection[]=$objects[$key];
          }
        }
      }
      return $newCollection;
    }
}
