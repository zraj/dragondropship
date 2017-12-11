<?php

namespace App;


class CatAttribute extends Model
{
    //
    public $timestamps = true;
    protected $table = 'cat_attributes';
    
      public function attribute()
    {
        return $this->hasOne('App\Attribute','attribute_id','attribute_id');
    }
     
}
