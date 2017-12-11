<?php

namespace App;


class Attribute extends Model
{
    //
    public $timestamps = true;
    protected $table = 'attributes';
      public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }
       public function values()
    {
        return $this->hasMany('App\AttributeValue','attribute_id','attribute_id');
    }
}
