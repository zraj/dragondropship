<?php

namespace App;


class Stores extends Model
{
    //
    public $timestamps = true;
    protected $table = "stores";


    public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier','supplier_id');
    }

    public function styles()
    {
          return $this->hasMany('App\Style','store_id','id');
    }
}
