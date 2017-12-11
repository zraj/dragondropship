<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
class Cart extends Model
{
  use SoftDeletes;
  public $timestamps = true;
  protected $table = "cart";
    protected $dates = ['deleted_at'];

  public function product()
  {
      return $this->hasOne('App\Product','id','product_id');
  }
}
