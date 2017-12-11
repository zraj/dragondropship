<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;


class Shop extends Model
{
  use SoftDeletes;

  public $timestamps = true;
  protected $table = "shop";
  protected $dates = ['deleted_at'];



  public function seller()
  {
      return $this->hasOne('App\User','id','shop_user');
  }

  public function reseller()
  {
      return $this->hasOne('App\Reseller','id','reseller_id');
  }

  public function stores()
  {
      return $this->hasOne('App\Stores','id','store_id');
  }
}
