<?php

namespace App;


class District extends Model
{
    protected $table = 'districts';

    public function province()
    {
       return $this->belongsTo('App\Province','PROVINCE_ID','PROVINCE_ID');
    }
}
