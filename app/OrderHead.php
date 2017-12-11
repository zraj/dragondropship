<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class OrderHead extends Model
{
    //
    use SoftDeletes;

   public $orderamount;
   public $timestamps = true;
   protected $table = "order_head";
   protected $dates = ['deleted_at'];

   public function getorderamount(){
     return OrderDetail::where('orderid',$this->id)->sum('amount');
   }

   public function orderd()
   {
     return $this->hasMany('App\OrderDetail','orderid','id');
   }

   public function shipping()
   {
     return $this->hasOne('App\Shipping','id','shipmethod');
   }

   public function owner()
   {
     return $this->hasOne('App\User','id','created_by');
   }


   public function getstatus(){
      switch ($this->status) {
        case config('constants.orderstatus.waiting'):
          return config('constants.orderstatus_message.waiting');
          break;
        case config('constants.orderstatus.processing'):
          return config('constants.orderstatus_message.processing');
          break;
        case config('constants.orderstatus.waitshipping'):
          return config('constants.orderstatus_message.waitshipping');
          break;
        case config('constants.orderstatus.shipping'):
          return config('constants.orderstatus_message.shipping');
          break;
        case config('constants.orderstatus.complete'):
          return config('constants.orderstatus_message.complete');
          break;
        case config('constants.orderstatus.cancel'):
          return config('constants.orderstatus_message.cancel');
          break;
        case config('constants.orderstatus.waitproduct'):
          return config('constants.orderstatus_message.waitproduct');
          break;
        default:
          # code...
          break;
      }
   }

}
