<?php

namespace App;



class AttributeValue extends Model
{
    public $timestamps = true;
    protected $table = 'attributes_values';
      public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }

      public function attribute_parent()
    {
        return $this->belongsTo('App\Attribute','attribute_id','attribute_id');
    }
}
