<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{

 use SoftDeletes;

 public $timestamps = true;
 protected $table = "product_inventory";
 protected $dates = ['deleted_at'];
}
