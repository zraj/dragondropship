<?php

namespace App\Http\Controllers;

use App\OrderHead;
use Illuminate\Http\Request;
use App\Cart;
use App\OrderDetail;
use App\Product;
use App\Shipping;
use DB;
use App\BankTran;
use App\Shop;
use App\Stores;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function review()
    {
      try {

        $orderh = new OrderHead;
        $orderh->name = request('input-name');
        $orderh->postcode = request('zipcode');
        $orderh->province = request('input-province');
        $orderh->city = request('input-amphur');
        $orderh->address = request('input-address');
        $orderh->telephone = request('input-telephone');
        $orderh->comments = request('input-comment');
        $orderh->shipmethod = request('shipmethod');
        $orderh->district = request('input-district');
        $orderh->created_by = auth()->user()->id;
        $cart = Cart::where('created_by',auth()->user()->id)->get();
        $weightcart = 0;
        $cart_amt = 0;
        foreach ($cart as $item) {
          $product = Product::findOrFail($item->product_id);
          $weightcart  = $weightcart + $product->weight * $item->qty;
          $cart_amt = $cart_amt + $product->getPrice(9) * $item->qty ;
        }
        $orderh->product_amt = $cart_amt;
        $orderh->sum_weight = $weightcart;

        $shipmethod = Shipping::findOrFail(request('shipmethod'));
        $shipcost = $shipmethod->getCost($weightcart,$shipmethod->id);
        $orderh->pre_shipping_amt = $shipcost;
        if (count($cart) == 0) {
          # code...
          session()->flash('message','ไม่มีสินค้าในตระกร้า');
          return redirect('/cart');
        }
        session(['orderh' => $orderh]);
        return view('order.review',compact('orderh','cart','weightcart','shipcost','shipmethod','cart_amt'));
      } catch (Exception $e) {

      }

    }

  public function createorder()
  {
      // dd(session('orderh'));
      try {
           DB::transaction(function () {
             $cart = Cart::where('created_by',auth()->user()->id)->get();
             $orderh = session('orderh');
             // create order log


             if ($orderh) {
               $orderh->save();
               \LogActivity::createlog(config('constants.logtype.orderstatus'),config('constants.action.order_created'),
               config('constants.orderstatus_message.waiting'),$orderh->id,auth()->user()->id);
                 foreach ($cart as $item) {
                    OrderDetail::create([
                      'orderid' => $orderh->id,
                      'product_id' => $item->product_id,
                      'qty' => $item->qty,
                      'price' => $item->product->getPrice(9),
                      'amount' => $item->qty * $item->product->getPrice(9)
                    ]);
                  }


                 Cart::where('created_by',auth()->user()->id)->delete();
                 $reseller = auth()->user()->shop->reseller->owner;


                 $result = BankTran::create([
                   'amount' => $orderh->product_amt * -1,
                   'trantype' => config('constants.trantype.buyproduct'),
                   'owner' => auth()->user()->shop->reseller->reseller_user,
                   'remarks' => 'ซื้อสินค้า',
                   'reference_code' => config('constants.doc_code.order').$orderh->id
                 ]);



                 $result2 = BankTran::create([
                   'amount' => $orderh->pre_shipping_amt * -1,
                   'trantype' => config('constants.trantype.shippingcost'),
                   'owner' => auth()->user()->shop->reseller->reseller_user,
                   'remarks' => 'ค่าจัดส่ง',
                   'reference_code' => config('constants.doc_code.order').$orderh->id
                 ]);

             }

               session(['orderh' => null]);
           });


        return redirect('/myorder');
      } catch (Exception $e) {

      }

  }

  public function myorder()
  {
    # code...
    try {
      $orders =null;
      if (auth()->user()->user_type == config('constants.admintype')) {
       $orders   = OrderHead::where('created_by',auth()->user()->id)->whereIn('status',[
          config('constants.orderstatus.waiting'),
          config('constants.orderstatus.waitproduct'),
          config('constants.orderstatus.processing')
          ])->orderBy('created_at','desc')->get();

      }
      if (auth()->user()->user_type == config('constants.suppliertype')) {
        $stores = Stores::where('supplier_id',auth()->user()->supplier->id)->pluck('id');
        $sellers = Shop::whereIn('store_id',$stores)->pluck('shop_user');
       $orders   = OrderHead::whereIn('created_by',$sellers)->whereIn('status',[
          config('constants.orderstatus.waiting'),
          config('constants.orderstatus.waitproduct'),
          config('constants.orderstatus.processing')
          ])->orderBy('created_at','desc')->get();

      }

      if (auth()->user()->user_type == config('constants.resellertype')) {
       $sellers = Shop::where('reseller_id',auth()->user()->reseller->id)->pluck('shop_user');
       $orders   = OrderHead::whereIn('created_by',$sellers)->whereIn('status',[
          config('constants.orderstatus.waiting'),
          config('constants.orderstatus.waitproduct'),
          config('constants.orderstatus.processing')
          ])->orderBy('created_at','desc')->get();

      }
      if (auth()->user()->user_type == config('constants.sellertype')) {
       $orders   = OrderHead::where('created_by',auth()->user()->id)->whereIn('status',[
          config('constants.orderstatus.waiting'),
          config('constants.orderstatus.waitproduct'),
          config('constants.orderstatus.processing')
          ])->orderBy('created_at','desc')->get();

      }
      // dd($orders);
       return view('order.myorder',compact('orders'));
    } catch (Exception $e) {

    }

  }


  public function orderview(OrderHead $order)
  {
     //dd($order->orderd);

     $orderlogs = \LogActivity::getbyref(config('constants.logtype.orderstatus'),$order->id);
     $ref_code = config('constants.doc_code.order').$order->id;
     $moneylogs = BankTran::where('reference_code',$ref_code)->get();

     return view('order.overview',compact('order','orderlogs','moneylogs'));
  }

  public function processorder(OrderHead $order)
  {
     //dd($order->orderd);
     if ($order->status == config('constants.orderstatus.waiting') || $order->status == config('constants.orderstatus.processing')) {
       # code...
       DB::transaction(function () use ($order) {
         $order->update([
           'status' => config('constants.orderstatus.processing')
         ]);
         \LogActivity::createlog(config('constants.logtype.orderstatus'),config('constants.action.order_process'),
         config('constants.orderstatus_message.processing'),$order->id,auth()->user()->id);
      });
         $orderlogs = \LogActivity::getbyref(config('constants.logtype.orderstatus'),$order->id);
         $ref_code = config('constants.doc_code.order').$order->id;
         $moneylogs = BankTran::where('reference_code',$ref_code)->get();
        //  $json_order = response()->json($order->orderd);
         return view('order.process',compact('order','orderlogs','moneylogs'));

    }else{
      session()->flash('message',config('constants.message.not_authorize'));
      return redirect('/myorder');
    }




  }



  public function cancelorder(OrderHead $order)
  {
    # code...
    $canChange = false;
    if (auth()->user()->user_type == config('constants.admintype')) {
      $canChange = true;
    }
    if ($order->created_by == auth()->user()->id) {
      $canChange = true;
    }

    if ($canChange == true) {
      foreach ($order->orderd as $d) {
        $d->delete();
      }
      $order->delete();

      session()->flash('message',config('constants.message.success_delete'));
      return redirect('/myorder');
    }else{
      session()->flash('message',config('constants.message.not_authorize'));
      return redirect('/myorder');
    }

  }

  public function json_orderdetail(OrderHead $order)
  {
    # code...
    $data = array();
    foreach ($order->orderd as $d) {
        $product = [
          'product' => $d->product,
          'qty' => $d->qty,
          'amt' => $d->amount,
          'price' => $d->price,
          'checked' => false
        ];

        array_push($data,$product);
    }
    return response()->json($data);
  }

  public function updatepacking(OrderHead $order)
  {


      $supplier = $order->owner->shop->stores->supplier;
      if (auth()->user()->id == $supplier->store_user) {
          DB::transaction(function () use ($order) {
              $order->update([
                'status' => config('constants.orderstatus.waitshipping')
              ]);
              \LogActivity::createlog(config('constants.logtype.orderstatus'),config('constants.action.order_process'),
              config('constants.orderstatus_message.waitshipping'),$order->id,auth()->user()->id);
           });
           return redirect('/ordership');
      }else{
        session()->flash('message',config('constants.message.not_authorize'));
        return redirect('/myorder');
      }


  }

  public function waitshippingorder()
  {
    try {
      $orders =null;
      if (auth()->user()->user_type == config('constants.admintype')) {
       $orders   = OrderHead::where('created_by',auth()->user()->id)->whereIn('status',[
          config('constants.orderstatus.waitshipping'),
          config('constants.orderstatus.shipping')
          ])->orderBy('created_at','desc')->get();

      }
      if (auth()->user()->user_type == config('constants.suppliertype')) {
        $stores = Stores::where('supplier_id',auth()->user()->supplier->id)->pluck('id');
        $sellers = Shop::whereIn('store_id',$stores)->pluck('shop_user');
       $orders   = OrderHead::whereIn('created_by',$sellers)->whereIn('status',[
         config('constants.orderstatus.waitshipping'),
         config('constants.orderstatus.shipping')
          ])->orderBy('created_at','desc')->get();

      }

      if (auth()->user()->user_type == config('constants.resellertype')) {
       $sellers = Shop::where('reseller_id',auth()->user()->reseller->id)->pluck('shop_user');
       $orders   = OrderHead::whereIn('created_by',$sellers)->whereIn('status',[
         config('constants.orderstatus.waitshipping'),
         config('constants.orderstatus.shipping')
          ])->orderBy('created_at','desc')->get();

      }
      if (auth()->user()->user_type == config('constants.sellertype')) {
       $orders   = OrderHead::where('created_by',auth()->user()->id)->whereIn('status',[
         config('constants.orderstatus.waitshipping'),
         config('constants.orderstatus.shipping')
          ])->orderBy('created_at','desc')->get();

      }
      // dd($orders);
       return view('order.ordership',compact('orders'));
    } catch (Exception $e) {

    }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderHead  $orderHead
     * @return \Illuminate\Http\Response
     */
    public function show(OrderHead $orderHead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderHead  $orderHead
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderHead $orderHead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderHead  $orderHead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderHead $orderHead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderHead  $orderHead
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderHead $orderHead)
    {
        //
    }
}
