<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logs;

class SysLogController extends Controller
{
    //


    public function createlog($type,$action,$message,$ref_id,$created_by)
    {
      # code...
      try {
        $result =  Logs::create([
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

    public function getbyref($type,$ref_id)
    {
      try {
        $result =  Logs::where('type',$type)->where('ref_id',$ref_id)->get();
          return $result;
      } catch (\Exception $e) {
         dd($e);
      }

    }
}
