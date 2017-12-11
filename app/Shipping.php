<?php

namespace App;
use App\ShippingCost;

class Shipping extends Model
{
    //

    protected $table = 'shipping_services';

    public $shipcost = 0;

    public function getCost($weight,$shipping_id)
    {
      $cost = ShippingCost::where([
        ['min_weight','<=' , $weight],
        ['max_weight','>',$weight],
        ['shipping_id','=',$shipping_id]
      ])->value('cost');
      return $cost;
    }
}
