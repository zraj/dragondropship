<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\StoreShipping;
use App\Shipping;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');


    }

    public function index()
    {
        try {
          $cart = Cart::where('created_by',auth()->user()->id)->get();
          $weightcart = 0;
          foreach ($cart as $item) {
            $product = Product::findOrFail($item->product_id);
            $weightcart  = $weightcart + $product->weight * $item->qty;
          }
          $storeshipings = StoreShipping::where('store_id',auth()->user()->shop->store_id)->pluck('shipping_service_id');
          $shippings = Shipping::whereIn('id',$storeshipings)->get();
          return view('cart.index',compact('cart','weightcart','shippings'));
        } catch (Exception $e) {
          dd($e);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function cartcount(){
      try {
         return Cart::where('created_by',auth()->user()->id)->count();
      } catch (\Exception $e) {
        dd($e);
      }

    }

    public function addcart()
    {
      try {
        if (request('qty') == "0") {
           session()->flash('message','จำนวนสินค้าต้องไม่เป็น 0');
           return redirect('/product');
        }
        $count = Cart::where([
          ['created_by',auth()->user()->id],
          ['product_id', request('productId') ]
          ])->count();  // check product same product in cart
          if ($count > 0) {
            $cart = Cart::where([
              ['created_by',auth()->user()->id],
              ['product_id', request('productId') ]
              ])->first();
            $cart->update([
              'qty' => $cart->qty + request('qty')
            ]);
          }else {
            $result = Cart::create([
              'product_id' => request('productId'),
              'qty' => request('qty'),
              'created_by' => auth()->user()->id
            ]);

          }
          return 'true';
      } catch (\Exception $e) {
        dd($e);
      }

    }

    public function getcart(){
      try {

      } catch (Exception $e) {
        dd($e);
      }

    }

    public function updateqty(Cart $cart)
    {
        try {
          if (request('qty') == "0") {
             session()->flash('message','จำนวนสินค้าต้องไม่เป็น 0');
             return redirect('/product');
          }
          $cart->update([
            'qty' => request('qty')
          ]);

          session()->flash('message',config('constants.message.success_update'));
          return 'true';
        } catch (Exception $e) {

        }

    }
    public function removecart(Cart $cart)
    {
        try {
          $cart->delete();

          session()->flash('message',config('constants.message.success_delete'));
          return redirect('/cart');
        } catch (Exception $e) {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
