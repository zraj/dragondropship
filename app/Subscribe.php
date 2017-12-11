<?php

namespace App;


class Subscribe extends Model
{
    //
    public $timestamps = true;
    protected $table = "reseller_subscribe";

    public function stores()
    {
        return $this->hasOne('App\Stores','store_id','id');
    }
}
