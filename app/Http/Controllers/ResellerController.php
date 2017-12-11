<?php

namespace App\Http\Controllers;

use App\Reseller;
use Illuminate\Http\Request;
use App\User;
use App\BankAccount;
use App\Province;
use App\Stores;
use App\Subscribe;
use App\Shop;

class ResellerController extends Controller
{


      public function __construct()
     {
         $this->middleware('auth');
        //  $this->middleware('admin');

     }


    public function index()
    {

        $resellers = Reseller::orderBy('reseller_name','asc')->get();
        return view('reseller.index',compact('resellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      try {
        $userid = Reseller::all()->pluck('reseller_user');
        $users =  User::where([
              ['user_type','=',config('constants.resellertype')]

          ])->orderBy('name','desc')->whereNotIn('id',$userid)->get();

        $banks = BankAccount::orderBy('name','asc')->get();
        $provinces = Province::orderBy('province_name','asc')->get();
        return view('reseller.create',compact('users','banks','provinces'));
       return view('reseller.create',compact('users'));
      } catch (Exception $e) {
        dd($e);
      }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        // dd(request());
        request()->file('id_card')->store('account/file','uploads');
        request()->file('img_bank')->store('account/file','uploads');
        $fileidcard = request()->file('id_card')->hashName();
        $filebank = request()->file('img_bank')->hashName();

        $result = Reseller::create([
              'reseller_name' => request('name'),
              'reseller_user' => request('store_owner'),
              'telephone' => request('telephone'),
              'address' => request('address'),
              'postcode' => request('postcode'),
              'bank_account' => request('bank_account'),
              'bank_type' => request('bank_type'),
              'bank_account_img' => $filebank,
              'id_card' => $fileidcard,
              'district' => request('district'),
              'city' => request('input-amphur'),
              'province' => request('input-province'),
              'created_by' => auth()->id()

        ]);
        session()->flash('message','Success create reseller');
        return redirect('reseller');
      } catch (Exception $e) {
          dd($e);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function show(Reseller $reseller)
    {

         $users =  User::where([
              ['user_type','=',config('constants.resellertype')]

          ])->orderBy('name','desc')->get();
          $banks = BankAccount::orderBy('name','asc')->get();
          $provinces = Province::orderBy('province_name','asc')->get();
          return view('reseller.show',compact('reseller','provinces','banks','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function edit(Reseller $reseller)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Reseller $reseller)
    {
        $filebank = $reseller->bank_account_img;
        $fileidcard = $reseller->id_card;
        if (request()->file('id_card')) {
         request()->file('id_card')->store('account/file','uploads');
           $fileidcard = request()->file('id_card')->hashName();
        }
        if (request()->file('img_bank')) {
          request()->file('img_bank')->store('account/file','uploads');
          $filebank = request()->file('img_bank')->hashName();
        }





        $result = Reseller::create([
              'reseller_name' => request('name'),
              'reseller_user' => request('store_owner'),
              'telephone' => request('telephone'),
              'address' => request('address'),
              'postcode' => request('postcode'),
              'bank_account' => request('bank_account'),
              'bank_type' => request('bank_type'),
              'bank_account_img' => $filebank,
              'id_card' => $fileidcard,
              'district' => request('district'),
              'city' => request('input-amphur'),
              'province' => request('input-province'),
              'created_by' => auth()->id()

        ]);
        session()->flash('message','Success Update reseller');
        return redirect('reseller');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reseller $reseller)
    {
        //
    }

    public function subscribe_index(Reseller $reseller)
    {
       try {
         $shops = Shop::where('reseller_id',$reseller->id)->get();
         $stores_id = Subscribe::where('reseller_id',$reseller->id)->pluck('store_id');
         $stores_subs = Stores::whereIn('id',$stores_id)->get();
         $stores = Stores::whereNotIn('id',$stores_id)->get();
         return view('reseller.subscribe',compact('stores','stores_subs','reseller','shops'));
       } catch (Exception $e) {

       }

    }
    public function subscribe_add()
    {
       try {
         $result = Subscribe::create([
           'store_id'=>request('store_id'),
           'reseller_id'=>request('reseller_id'),
           'created_by' => auth()->user()->id
         ]);
         return redirect('/subscribe/'.request('reseller_id'));
       } catch (Exception $e) {

       }
    }

    public function subscribe_create()
    {
        try {
           $reseller = Reseller::findOrFail(request('reseller_id'));
           $store = Stores::findOrFail(request('store_id'));
           $shopuser = Shop::all()->pluck('shop_user');

           $sellers = User::where('user_type',1)->whereNotIn('id',$shopuser)->get();
          //  dd($sellers);
           return view('shop.create',compact('reseller','store','sellers'));
        } catch (\Exception $e) {
           session()->flash('message',$e->getMessage());
           return back();
        }


    }

    public function subscribe_remove()
    {
       try {
         $result = Subscribe::where([
           ['store_id',request('store_id')],
           ['reseller_id',request('reseller_id')]
         ])->delete();
         return redirect('/subscribe/'.request('reseller_id'));
       } catch (Exception $e) {

       }
    }
}
