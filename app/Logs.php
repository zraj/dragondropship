<?php

namespace App;


class Logs extends Model
{
    public $timestamps = true;
    protected $table = "syslog";
    public function creator()
    {
        return $this->hasOne('App\User','id','created_by');
    }
}
