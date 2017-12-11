<?php

namespace App;


class Address extends Model
{
  protected $table = 'zipcodes';

  public function district()
{
   return $this->hasOne('App\District','DISTRICT_CODE','district_code');
}
}
