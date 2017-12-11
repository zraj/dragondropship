<?php

namespace App;


class Supplier extends Model
{
    //
    public $timestamps = true;
    protected $table = "suppliers";

    public function owner()
    {
        return $this->hasOne('App\User','id','store_user');
    }
    public function banktype()
    {
        return $this->hasOne('App\BankAccount','id','bank_type');
    }


    public function stores(){
          return $this->hasMany('App\Stores','supplier_id','id');
    }


}
