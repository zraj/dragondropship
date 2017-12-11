@extends('layouts.app')

@section('content')
  <div class="card">
      <div class="card-header">
          <i class="fa fa-product-hunt"></i> My Order - กำลังจัดส่ง

      </div>
      <div class="card-block">
        <div class="col-10">
          <table class="table table-striped">
              <thead>
                <th class="text-left">เลขที่</th>
                <th class="text-left">ผู้สั่งซื้อ</th>
                <th class="text-left">เบอร์โทร</th>
                <th class="text-right">ยอดเงิน</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">วันที่สั่งซื้อ</th>
                <th></th>
              </thead>
              <tbody>

                     @foreach ($orders as $order)
                         <tr>
                          <td class="text-left"><a href="/orderview/{{$order->id}}">{{config('constants.doc_code.order').$order->id}}</a></td>
                          <td class="text-left">{{$order->name}}</td>
                          <td class="text-left">{{$order->telephone}}</td>
                          @if ($order->status == config('constants.orderstatus.complete'))
                            <td class="text-right">{{number_format($order->getorderamount() + $order->real_shipping_amt ,0) }}</td>
                          @else
                            <td class="text-right">{{number_format($order->getorderamount() + $order->pre_shipping_amt ,0) }}</td>
                          @endif

                          <td class="text-center"><span class="badge badge-pill badge-info">{{$order->getstatus()}}</span></td>
                          <td class="text-right">{{$order->created_at->format('d/m/Y  h:i:s')}}</td>
                          <td class="text-right">
                            {{-- <button class="btn btn-info" type="button" name="button">view</button> --}}

                          @if (Auth::user()->user_type == config('constants.sellertype') || Auth::user()->user_type == config('constants.admintype'))
                            @if ($order->status == config('constants.orderstatus.waiting') || $order->status == config('constants.orderstatus.waitproduct') )
                              <a href="/cancelorder/{{$order->id}}" class="btn btn-danger">ยกเลิก</a></a>
                            @endif
                          @endif
                          @if (Auth::user()->user_type == config('constants.suppliertype'))
                            @if ($order->status == config('constants.orderstatus.waitshipping'))
                              <a href="/orderview/{{$order->id}}" class="btn btn-danger">ทำการส่งของ</a></a>
                            @endif
                          @endif


                          </td>
                           </tr>
                     @endforeach

              </tbody>
          </table>

          <div class="">
              <button type="button" class="btn btn-danger">
                 ส่งทั้งหมด
              </button>
          </div>


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
