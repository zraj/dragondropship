<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $balance;
    protected $fillable = [
        'name', 'email','username','password','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function usertypes()
    {
        return $this->hasOne('App\UserType','user_type','user_type');
    }

    public function reseller()
    {
        return $this->hasOne('App\Reseller','reseller_user','id');
    }
    public function supplier()
    {
        return $this->hasOne('App\Supplier','store_user','id');
    }

    public function shop()
    {
        return $this->hasOne('App\Shop','shop_user','id');
    }


    public function getbalance()
    {
        try {
          // if (auth()->user()->user_type == config('constants.resellertype')) {
             $sum_balance = BankTran::where([
               ['owner',auth()->user()->id],
             ['status',1]
             ])->sum('amount');
             return $sum_balance;
          // }else{
            //  return 999999;
          // }
        } catch (Exception $e) {
           dd($e);
        }


    }

}
