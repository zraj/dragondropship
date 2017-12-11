<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderDetail extends Model
{
    //
    use SoftDeletes;

   public $timestamps = true;
   protected $table = "order_detail";
   protected $dates = ['deleted_at'];

   public function product()
   {
       return $this->hasOne('App\Product','id','product_id');
   }

}
