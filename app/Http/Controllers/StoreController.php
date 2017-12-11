<?php

namespace App\Http\Controllers;

use App\Stores;
use App\Supplier;
use App\Shipping;
use App\StoreShipping;
use Illuminate\Http\Request;
use DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Stores::orderBy('store_name','asc')->get();


        return view('store.index',compact('stores'));

    }

    public function storegroup($supplier_id){
      $stores = Stores::where('supplier_id',$supplier_id)->orderBy('store_name','asc')->get();


      return view('store.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $shippings = Shipping::all();
        $suppliers = Supplier::orderBy('supplier_name','asc')->get();

        return view('store.create',compact('suppliers','shippings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
          //  dd($request);

           DB::transaction(function () {

             $result = Stores::create([
               'store_name' => request('store-name'),
               'short_name' => request('short-name'),
               'supplier_id' => request('input-supplier'),
               'created_by' => auth()->id()
             ]);

             foreach (request('input-shipping') as $shipping) {
                 StoreShipping::create([
                     'store_id' => $result->id,
                     'shipping_service_id' => $shipping
                 ]);
             }

             session()->flash('message',config('constants.msg_add_complete'));
            });

           return redirect('/store');
        } catch (Exception $e) {
           dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function show(Stores $stores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function edit(Stores $store)
    {
         $suppliers = Supplier::orderBy('supplier_name','asc')->get();
         $storeships = StoreShipping::where('store_id',$store->id)->pluck('shipping_service_id');
         $canship = Shipping::whereIn('id',$storeships)->get();
         $cantship = Shipping::whereNotIn('id',$storeships)->get();

        return view('store.edit',compact('store','suppliers','cantship','canship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stores $stores)
    {
      //   dd($stores);
         $store_id = $stores->id;

             DB::transaction(function () use ($store_id) {
            $result = Stores::findOrFail($store_id)->update([
              'store_name' => request('store-name'),
              'short_name' => request('short-name'),
              'supplier_id' => request('input-supplier'),
              'created_by' => auth()->id()
            ]);
            StoreShipping::where('store_id',$store_id)->delete();

            foreach (request('input-shipping') as $shipping) {
                StoreShipping::create([
                    'store_id' => $store_id,
                    'shipping_service_id' => $shipping
                ]);
            }
            session()->flash('message','Success update store');
            });


          return redirect('/store');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stores  $stores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stores $stores)
    {
        //
    }
}
