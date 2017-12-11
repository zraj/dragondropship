<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
     use SoftDeletes;

    public $timestamps = true;
    protected $table = "products";
    protected $dates = ['deleted_at'];

        public function category()
    {
        return $this->hasOne('App\Category','category_id','category_id');
    }
    public function creator()
    {
        return $this->hasOne('App\User','id','created_by');
    }

    public function store()
    {
        return $this->hasOne('App\Stores','id','store_id');
    }

    public function attributes(){
          return $this->hasMany('App\ProductAttribute','product_id','id');
    }

     public function gallery(){
          return $this->hasMany('App\Photo','ref_id','id');
    }

    public function style(){
      return $this->hasOne('App\Style','id','style_id');
    }

    public function getPrice($level)
    {
      return $this->L1;
    }

    // Prduct Status 0 = Pending, 1 Active, 2 Not Active,3 Others
}
