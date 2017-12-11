@extends('layouts.app')

@section('content')
  <div class="card">
      <div class="card-header">
          <i class="fa fa-product-hunt"></i> Order Review

      </div>
      <div class="card-block">
        <div class="col-10">
          <form class="" action="/createorder" method="post">
            {{ csrf_field() }}
            <div class="ch-box shippingto_container">
            <h3 class="ch-main-title">
                ส่งที่
            </h3>
            <div class="ch-shipping-to">
                <div class="address checkout-address _block" data-location="กรุงเทพมหานคร/ Bangkok - บางคอแหลม/ Bang Kho Laem - 10120">
                      <p class="ch-head checkout-address _name">{{ $orderh->name}}</p>
                      <p>{{$orderh->address.' '.$orderh->district.' '.$orderh->city.' '.$orderh->province.' '.$orderh->postcode}}</p>
                      <p>โทรศัพท์: {{$orderh->telephone}}</p>
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
                 @foreach ($cart as $item)
                   @php
                      $sumamt = $sumamt + $item->product->L1 * $item->qty;
                   @endphp

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
                   <td>ค่าจัดส่ง({{$shipmethod->name}} - น้ำหนัก {{$weightcart}} กรัม)</td>
                   <td>-</td>
                   <td  class="text-right"></td>
                   <td  class="text-right">{{number_format($shipcost,0)}}</td>
                   <td><strong>บาท</strong></td>
                 </tr>
                  <tr>
                    <td><strong>รวม</strong></td>
                    <td >-</td>
                    <td  class="text-right"><strong>{{$cart->sum('qty')}}</strong></td>
                    <td  class="text-right"><strong>{{number_format($cart_amt+$shipcost,0)}}</strong></td>
                    <td><strong>บาท</strong></td>
                  </tr>

                </tbody>
            </table>

            <input class="btn btn-info" type="submit" name="" value="ยืนยันสั่งซื้อ">

          </form>


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
