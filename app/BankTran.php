<?php

namespace App;



class BankTran extends Model
{
  public $timestamps = true;
  protected $table = "bank_transaction";

  public function frombank()
  {
      return $this->hasOne('App\BankAccount','id','from_bank_type');
  }
  public function tobank()
  {
      return $this->hasOne('App\BankAccount','id','to_bank_type');
  }

  public function tran_owner(){
     return $this->hasOne('App\User','id','owner');
  }
}
