@extends('layouts.app')

@section('content')
  <div class="card">
      <div class="card-header">
          <i class="fa fa-product-hunt"></i> Order Detail

      </div>
      <div class="card-block">
        <div class="col-12">
            <div class="row">
                 <div class="col-4">
                   <div class="ch-box shippingto_container">
                       <h4 class="ch-main-title">
                           รายละเอียดสั่งซื้อ
                       </h4>
                       <div class="ch-shipping-to">
                           <div class="address checkout-address _block" data-location="กรุงเทพมหานคร/ Bangkok - บางคอแหลม/ Bang Kho Laem - 10120">
                                 <p>เลขที่ใบสั่งซื้อ :<strong> {{config('constants.doc_code.order').$order->id}}</strong></p>
                                  <p>ร้านค้า : <strong>{{$order->owner->shop->shop_name}}</strong></p>
                                  <p>store : <strong>{{$order->owner->shop->stores->store_name}}</strong></p>
                                 <p class="ch-head checkout-address _name">ชื่อลูกค้า :<strong>{{ $order->name}}</strong></p>
                                 <p>ที่อยู่จัดส่ง:<br>{{$order->address.' '.$order->district.' '.$order->city.' '.$order->province.' '.$order->postcode}}</p>
                                 <p>โทรศัพท์: {{$order->telephone}}</p>
                                 <p>สถานะ : {{$order->getstatus()}}</p>
                                 @if ($order->status == config('constants.orderstatus.waiting') || $order->status == config('constants.orderstatus.waitproduct') || $order->status == config('constants.orderstatus.processing'))
                                    @if (auth()->user()->user_type == config('constants.suppliertype'))
                                           <p><a href="/processorder/{{$order->id}}" class="btn btn-warning">จัดของ</a></p>
                                    @endif

                                 @endif
                          </div>
                       </div>
                       <div class="">

                       </div>
                   </div>
                 </div>
                 <div class="col-4">
                   <div class="ch-box shippingto_container">
                       <h4 class="ch-main-title">
                           ประวัติรายการ
                       </h4>
                       <div class="ch-shipping-to">
                         @foreach ($orderlogs as $log)
                             <p>{{$log->action}} : {{$log->message}}</p>
                         @endforeach
                       </div>
                   </div>
                 </div>
                 <div class="col-4">
                   <div class="ch-box shippingto_container">
                       <h4 class="ch-main-title">
                           การเงิน
                       </h4>
                       <div class="ch-shipping-to">
                         @foreach ($moneylogs as $transaction)
                             <p>{{$transaction->trantype}} : {{$transaction->amount}}</p>
                         @endforeach

                       </div>
                   </div>
                 </div>
            </div>


            <table class="table table-responsive table-striped " id="cartdetail">
               <thead>
                   <th>สินค้า</th>
                    <th  class="text-right">ราคาต่อชิ้น</th>
                   <th  class="text-right">จำนวน</th>

                   <th class="text-right">ราคารวม</th>
                   <th></th>
               </thead>
               <tbody>
                @php
                  $sumamt = 0;
                @endphp
                 @foreach ($order->orderd as $item)


                    <tr>
                      <td><a href="/product/{{$item->product_id}}" target="_blank">{{$item->product->product_name}}</a> (มีสินค้า:{{$item->product->qty}} ชิ้น)</td>

                      <td  class="text-right">{{$item->product->L1}}</td>
                        <td  class="text-right">

                          {{$item->qty}}

                        </td>
                      <td class="text-right">{{number_format($item->product->L1 * $item->qty,0)}}</td>
                      <td>

                      </td>

                    </tr>

                 @endforeach
                 <tr>
                   <td>ค่าจัดส่งประมาณ({{$order->shipping->name}} - น้ำหนัก {{$order->sum_weight}} กรัม)</td>
                   <td>-</td>
                   <td  class="text-right"></td>
                   <td  class="text-right">{{number_format($order->pre_shipping_amt,0)}}</td>
                   <td><strong>บาท</strong></td>
                 </tr>
                  <tr>
                    <td><strong>รวม</strong></td>
                    <td >-</td>
                    <td  class="text-right"><strong>{{$order->orderd->sum('qty')}}</strong></td>
                    <td  class="text-right"><strong>{{number_format($order->product_amt+$order->pre_shipping_amt,0)}}</strong></td>
                    <td><strong>บาท</strong></td>
                  </tr>

                </tbody>
            </table>

            <a href="/myorder" class="btn btn-info">BACK</a>





       </div>
      </div>
      <div class="">
           <br>
           <br>
           <br>
           <br>
      </div>
  </div>
@endsection
