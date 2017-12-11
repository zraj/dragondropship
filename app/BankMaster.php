<?php

namespace App;



class BankMaster extends Model
{
  public $timestamps = true;
  protected $table = "bank_master";

  public function banktype()
  {
      return $this->hasOne('App\BankAccount','id','bank_type');
  }
}
