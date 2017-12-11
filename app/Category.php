<?php

namespace App;


class Category extends Model
{
    //
    public $timestamps = true;
    protected $table = 'category';
    public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }

      public function attributes()
    {
        return $this->hasMany('App\CatAttribute','category_id','category_id');
    }


}
