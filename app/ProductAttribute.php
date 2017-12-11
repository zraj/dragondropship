<?php

namespace App;


class ProductAttribute extends Model
{
    //
    public $timestamps = true;
    protected $table = "products_attributes";

    public function attribute()
    {
        return $this->hasOne('App\AttributeValue','att_value_id','att_value_id');
    }    
}
