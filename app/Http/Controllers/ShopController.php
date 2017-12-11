<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class ShopController extends Controller
{
    public function __construct()
    {
      # code...
    }

    public function store()
    {
        try {
        //    dd(request());
            Shop::create([
               'shop_user' => request('input-seller'),
               'reseller_id' => request('input-resellerid'),
               'shop_name' => request('input-shopname'),
               'address_1' => request('input-address1'),
               'address_2' => request('input-address2'),
               'tel_number' => request('input-mobile'),
               'store_id' => request('input-storeid'),
               'created_by' =>auth()->user()->id
            ]);

            return redirect('/subscribe/'.request('input-resellerid'));

        } catch (\Exception $e) {
          session()->flash('message',$e->getMessage());
          return redirect()->back();
        }

    }


    public function remove()
    {
      try {
      //  dd(request());
        $shop = Shop::findOrFail(request('input-shopid'));
        if ($shop) {
           $shop->delete();
        }
        return redirect('/subscribe/'.request('reseller_id'));
      } catch (\Exception $e) {
        session()->flash('message',$e->getMessage());
        return redirect()->back();
      }

    }
}
