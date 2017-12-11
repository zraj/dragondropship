@extends('layouts.app')

@section('content')
  <div class="card">
      <div class="card-header">
          <i class="fa fa-product-hunt"></i> Order Detail

      </div>
      <div class="card-block" id="processorder">
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
                   <div class="row container-fluid">
                     <label for="">บาร์โค๊ด</label>
                       <input @keyup.enter="action" v-model="barcode" type="text" name="" class="form-control input-focus" value="" placeholder="ยิงบาร์โค๊ดจัดของ">
                       <input type="hidden" v-bind="orderid" name="input-orderid" value="{{$order->id}}">
                   </div>
                 </div>
            </div>


            <table class="table table-responsive table-striped " >
               <thead>
                 <th>#</th>
                   <th>สินค้า</th>

                    <th  class="text-right">ราคาต่อชิ้น</th>
                   <th  class="text-right">จำนวน</th>
                   <th class="text-right">ราคารวม</th>
                   <th></th>
               </thead>
               <tbody>

                 <tr v-for="odr in orderdetail">
                   <td v-bind:class="{ 'color-green': odr.checked }"><input type="hidden" name="item[]"  v-bind:value="odr"  >
                       <i class="icon-flag"  v-show="odr.checked">
                   </td>
                   <td>[@{{odr.product.item_code}}]-@{{odr.product.product_name}}-(คงเหลือ @{{odr.product.qty}})</td>

                   <td  class="text-right">@{{odr.price}}</td>
                     <td  class="text-right">

                       @{{odr.qty}}

                     </td>
                   <td class="text-right">@{{odr.amt}}</td>
                   <td>

                   </td
                 </tr>
                {{-- @php
                  $sumamt = 0;
                @endphp
                 @foreach ($order->orderd as $item)


                    <tr>
                      <td>{{$loop->index + 1}}</td>
                      <td>[{{$item->product->item_code}}]-<a href="/product/{{$item->product_id}}" target="_blank">{{$item->product->product_name}}</a> (มีสินค้า:{{$item->product->qty}} ชิ้น)</td>

                      <td  class="text-right">{{$item->product->L1}}</td>
                        <td  class="text-right">

                          {{$item->qty}}

                        </td>
                      <td class="text-right">{{number_format($item->product->L1 * $item->qty,0)}}</td>
                      <td>

                      </td>

                    </tr>

                 @endforeach --}}
                 <tr>
                   <td></td>
                   <td>ค่าจัดส่งประมาณ({{$order->shipping->name}} - น้ำหนัก {{$order->sum_weight}} กรัม)</td>

                   <td>-</td>
                   <td  class="text-right"></td>
                   <td  class="text-right">{{number_format($order->pre_shipping_amt,0)}}</td>
                   <td><strong>บาท</strong></td>
                 </tr>
                  <tr>

                    <td></td>
                    <td><strong>รวม</strong></td>
                    <td >-</td>
                    <td  class="text-right"><strong>{{$order->orderd->sum('qty')}}</strong></td>
                    <td  class="text-right"><strong>{{number_format($order->product_amt+$order->pre_shipping_amt,0)}}</strong></td>
                    <td><strong>บาท</strong></td>
                  </tr>

                </tbody>
            </table>

            <a href="/updatepacking/{{$order->id}}" class="btn btn-danger" v-show="packcomplete">ยืนยันจัดของ</a>





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

@section('user_script')

  <script type="text/javascript">
var csrf_token = $('meta[name="csrf-token"]').attr('content');

Vue.component('my-component', {
  template: `
  <tr v-for="odr in orderdetail">
    <td></td>
    <td>@{{odr.product_id}}</td>

    <td  class="text-right">@{{odr.price}}</td>
      <td  class="text-right">

        @{{odr.qty}}

      </td>
    <td class="text-right">@{{odr.amount}}</td>
    <td>

    </td
  </tr>
  `,
  data: function () {
   return {
      orderdetail : [],
   }
 },
 methods: {
 },
});

var processapp =  new Vue({
    el:'#processorder',
    data:{
       orderdetail : [],
       barcode : '',
       orderid : '',
       packcomplete:false,
    },
    methods:{
      action(event) {
                 if (this.barcode.length > 1) {
                  // alert(this.barcode);
                  var self = this;
                  console.log(this.orderdetail.filter(function(ord){return ord.product.item_code.indexOf(self.barcode)>=0;}));
                   var item = this.orderdetail.filter(function(ord){return ord.product.item_code.indexOf(self.barcode)>=0;});
                   alert('ITEM : ' + item[0].product.product_name + ' จำนวน ' +  item[0].qty);
                   item[0].checked = true;
                   this.barcode = '';
                   this.checkComplete();
                 }else{
                  this.barcode = '';
                 }
               },
      getData(){
        axios.get('/getorderdetail/'+ {{$order->id}})
        .then(
          response => this.orderdetail = response.data
        );
      },
      checkComplete(){
         var complete = true;
         this.orderdetail.forEach(function(odr){
          //  alert(odr.checked);
          if (odr.checked == false) {
             complete = false;
          }
         });
         if (complete == true) {
            this.packcomplete = true;
         }
      }
    },
    mounted(){
      this.getData();
    }
  });
  </script>
  <style media="screen">
        .color-green{
              background-color: lightgreen;
        }
  </style>
@endsection
