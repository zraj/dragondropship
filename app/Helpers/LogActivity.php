<?php

namespace App\Helpers;
use Request;
use App\Logs as LogActivityModel;

class LogActivity
{


    public static function createlog($type,$action,$message,$ref_id,$created_by)
    {

      try {
        $result =  LogActivityModel::create([
             'type' => $type,
             'action' => $action,
             'message' => $message,
             'ref_id' => $ref_id,
             'created_by' => $created_by
          ]);
          return $result;
      } catch (\Exception $e) {
         dd($e);
      }


    }

    public static function getbyref($type,$ref_id)
    {
      try {
        $result =  LogActivityModel::where('type',$type)->where('ref_id',$ref_id)->get();
          return $result;
      } catch (\Exception $e) {
         dd($e);
      }

    }

}
