@extends('layouts.app')

@section('content')

  <div class="card">
      <div class="card-header">
          <i class="fa fa-product-hunt"></i>ตะกร้าสินค้า

      </div>
      <div class="card-block">

       <div class="container-fluid">
                  <div class="animated fadeIn">
                     <div class="row">
                       <div class="container-fluid">
                            <form id="order-form" method="post" action="/orderreview">
                              {{ csrf_field() }}
                              <div class="form-group row">
                                <label for="input-name" class="col-sm-2 form-control-label text-right">ชื่อผู้รับ</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="input-name" id="input-name" required placeholder="">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input-address" class="col-sm-2 form-control-label text-right">รหัสไปรษณีย์</label>
                                <div class="col-sm-10">
                                  <input type="text" maxlength="5" size="5" name="zipcode" required  id="zipcode" placeholder="">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input-province" class="col-sm-2 form-control-label text-right">จังหวัด</label>
                                 <div class="col-sm-10" id="address-province">


                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input-city" class="col-sm-2 form-control-label text-right">เขต/อำเภอ</label>
                                <div class="col-sm-10" id="address-city">

                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input-city" class="col-sm-2 form-control-label text-right">แขวง/ตำบล</label>
                                <div class="col-sm-10" id="address-district">
                                    <input type="text" maxlength="40" size="40" class="" name="input-district" id="input-district" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input-address" class="col-sm-2 form-control-label text-right">ที่อยู่</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="input-address" id="input-address" placeholder="">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input-telephone" class="col-sm-2 form-control-label text-right">มือถือ</label>
                                <div class="col-sm-10">
                                  <input type="text" maxlength="12" size="12" class="" name="input-telephone" id="input-telephone" placeholder="">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input-comment" class="col-sm-2 form-control-label text-right">คอมเม้น</label>
                                <div class="col-sm-10">
                                  <textarea  class="form-control" name="input-comment" rows="4" cols="80">

                                  </textarea>

                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 text-right">ตัวเลือกการจัดส่ง</label>
                                <div class="col-sm-10">
                                  @foreach ($shippings as $shipping)
                                    <div class="radio">
                                      <label>
                                        @if ($loop->first)
                                            <input type="radio" name="shipmethod" id="gridRadios1" value="{{$shipping->id}}" checked>
                                        @else
                                            <input type="radio" name="shipmethod" id="gridRadios1" value="{{$shipping->id}}">
                                        @endif

                                         {{$shipping->name}} ค่าส่งประมาณ {{$shipping->getCost($weightcart,$shipping->id)}} บาท (น้ำหนัก{{ $weightcart}} กรัม)
                                      </label>
                                    </div>
                                  @endforeach


                                </div>
                              </div>

                              <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10">
                                  {{-- <button type="submit" class="btn btn-secondary">สั่งซื้อสินค้า</button> --}}
                                </div>
                              </div>
                            </form>
                       </div>
                    </div>
                    {{-- end row  --}}
                      <hr>
                    <div class="row">
                       <div class="col-1">

                       </div>
                       <div class="col-10">
                         <p class="text-center"><strong>ตระกร้าสินค้า</strong></p>
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
                                          <a href="#" @click="(event) => { showDialog({ id:{{$item->id}},qty:{{$item->qty}}}) } "><span class="badge badge-pill badge-warning">แก้ไข</span></a>
                                        {{$item->qty}}

                                      </td>
                                    <td class="text-right">{{number_format($item->product->L1 * $item->qty,0)}}</td>
                                    <td>
                                      @component('layouts.btndel',['method'=>'POST',
                                        'action'=>'/removecart/'.$item->id,
                                        'inputname'=>'id',
                                        'id'=> $item->id,
                                        'deltext'=> '',
                                        'delete_tag'=> false,
                                        'class' => 'dosubmit btn-danger' ])
                                        @endcomponent
                                      {{-- <button class="btn btn-danger" type="button" name="button"><span class="fa fa-trash-o"></span>
                                      </button> --}}
                                    </td>

                                  </tr>

                               @endforeach
                                <tr>
                                  <td><strong>รวม</strong></td>
                                  <td >-</td>
                                  <td  class="text-right"><strong>{{$cart->sum('qty')}}</strong></td>
                                  <td  class="text-right"><strong>{{number_format($sumamt,0)}}</strong></td>
                                  <td><strong>บาท</strong></td>
                                </tr>
                                <tr id="update-box" style="display:none;">
                                  <td>แก้ไขจำนวน</td>
                                  <td></td>
                                  <td><input type="hidden" name="id" v-model="productid"></td>
                                   <td>
                                     <input id="qty-box" size="3" type="text" name="qty" v-model="productqty">
                                   </td>
                                   <td>
                                     <button class="btn btn-success" @click="updateQty" type="button" name="button">อัพเดท</button>
                                    <button class="btn btn-danger" @click="cancelUpdate" type="button" name="button">ยกเลิก</button>
                                   </td>
                                </tr>
                              </tbody>
                          </table>
                      </div>

                    </div>
                    {{-- end row --}}

                  </div>

              </div>
              <!-- /.conainer-fluid -->


      </div>
      {{-- end card block --}}
        <a href="#" id="submit-order" class="btn btn-warning" role="button">สั่งซื้อ</a>
  </div>





@endsection
@section('user_script')

<script type="text/javascript">

$('#submit-order').click(function(){
   if ($('#input-name').val() =='') {
     alert('กรุณากรอกชื่อผู้รับ')
   }else if ($('#zipcode').val() =='') {
     alert('กรุณากรอกรหัสไปรษณีย์')
   }else if ($('#input-address').val() =='') {
     alert('กรุณากรอกที่อยู่')
   }else {
       $('#order-form').submit();
   }

});

    $( "#zipcode" ).change(function(){
        if ($('#zipcode').val().length == 5) {
            $.ajax({

                    type: "GET",
                    url: "/amphur/"+ $('#zipcode').val(),
                    dataType: 'html',
                    success: function (data) {
                      //  alert(data);
                      if (data == "") {
                        alert("กรุณากรอกรหัสไปรษณีย์ให้ถูกต้อง");
                      }
                        $('#address-city').html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);

                    }
                });

                $.ajax({

                        type: "GET",
                        url: "/province/"+ $('#zipcode').val(),
                        dataType: 'html',
                        success: function (data) {
                        //    alert(data);
                            $('#address-province').html(data);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#product-att').html(data);
                        }
                    });
        }else{
            alert("กรุณากรอกรหัสไปรษณีย์ให้ครบถ้วน");
            $('#zipcode').focus();
        }
    });

$(".dosubmit").on("submit", function () {
   return confirm("ยกเลิกรายการ ?");
});

var csrf_token = $('meta[name="csrf-token"]').attr('content');


new Vue({
  el:'#cartdetail',
  data:{
     cart:'',
     productid:0,
     productqty:0
  },
  methods:{
    showDialog(data){
      //  alert('update' + data.qty);
        $('#update-box').show();
        $('#qty-box').focus();
        this.productid = data.id;
        this.productqty = data.qty;
    },
    updateQty(){
      // alert('Data:' + this.productid + '-' + this.productqty);
      axios.post('/updatecartqty/'+ this.productid, {
         cartid: this.productid,
         qty: this.productqty,
         token:csrf_token
       })
       .then(function (response) {

         if (response.data == true) {
            window.location = '/cart';
         }else{
           alert('Error Add Item');
         }
         console.log(response);
       })
       .catch(function (error) {
         alert('Error Add Item(catched)');
         console.log(error);
       });

      this.productid = 0;
      this.productqty = 0;
      $('#update-box').hide();
    },
    cancelUpdate(){
         $('#update-box').hide();
    }
  },
  mounted(){

  }
});
</script>
@endsection
