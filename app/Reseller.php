<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reseller extends Model
{
   use SoftDeletes;

  public $timestamps = true;
  protected $table = "reseller";
    protected $dates = ['deleted_at'];

  public function owner()
  {
      return $this->hasOne('App\User','id','reseller_user');
  }

  public function stores(){
    return $this->hasMany('App\Subscribe','reseller_id','id');
  }

  public function banktype()
  {
      return $this->hasOne('App\BankAccount','id','bank_type');
  }

}
