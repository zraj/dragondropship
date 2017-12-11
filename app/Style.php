<?php

namespace App;



class Style extends Model
{
    //
    public $timestamps = true;
    protected $table = "styles";

    public function store()
    {
        return $this->belongsTo('App\Stores','store_id');
    }
    public function category()
    {
        return $this->hasOne('App\Category','category_id','category_id');
    }
}
