@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>แก้ไข reseller
    </div>
    <div class="card-block">

        <form method="POST" action="/reseller/{{$reseller->id}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="row form-group">
                <div class="col-2">ชื่อร้านค้า/บริษัท:</div>
                <div class="col-6">
                   <input type="text" class="form-control" name="name" required="" value="{{$reseller->reseller_name}}">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-2">Login เจ้าของร้าน:</div>
                <div class="col-3">
                  <select class="form-control" name="store_owner" id="">
                     @foreach($users as $user)
                       @if ($user->id == $reseller->store_user)
                          <option value="{{$user->id}}" selected>{{$user->name}}</option>
                       @else
                          <option value="{{$user->id}}">{{$user->name}}</option>
                       @endif

                     @endforeach
                  </select>


                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">เบอร์โทร:</div>
                <div class="col-6">
                   <input type="text" class="form-control" name="telephone" required="" value="{{$reseller->telephone }}">
                </div>
            </div>

           <div class="row form-group">
              <div class="col-2">รหัสไปรษณีย์:</div>
              <div class="col-2 col-offset-4">
                 <input type="text" size="5" maxlength="5" class="form-control" value="{{$reseller->postcode }}" id="zipcode" name="postcode" required="">
              </div>
          </div>
             <div class="row form-group">
                <div class="col-2">ที่อยู่:</div>
                <div class="col-6">
                   <input type="text" class="form-control" name="address" required="" value="{{$reseller->address }}">
                </div>
            </div>
            <div class="row form-group">
               <div class="col-2">แขวง/ตำบล:</div>
               <div class="col-6">
                  <input type="text" class="form-control" value="{{$reseller->district }}" name="district" required="">
               </div>
           </div>
            <div class="row form-group">
               <div class="col-2">เขต/อำเภอ:</div>
               <div class="col-6">
                 <div id="address-amphur">
                    <select class="form-control" name="input-amphur">
                         <option value="{{$reseller->city }}">{{$reseller->city }}</option>
                    </select>
                 </div>
               </div>
           </div>
           <div class="row form-group">
              <div class="col-2">จังหวัด:</div>
              <div class="col-6">
                <div id="address-province">
                      <select class="form-control" name="input-province">
                         <option value="{{$reseller->province }}">{{$reseller->province }}</option>
                      </select>
                </div>
              </div>
           </div>



            <div class="form-group row">
               <div class="col-2">รูปบัตรประชาชน:</div>
                <div class="col-6">
                    <a href="{{ asset('uploads/account/file/'.$reseller->id_card) }}" data-lightbox="product-image">
                  <img width="100px;" src="{{ asset('uploads/account/file/'.$reseller->id_card) }}" alt="">
                </a>
                     <input type="file" class="form-control-file" id="photo-image" name="id_card" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Please input file jpg or png.</small>
               </div>
            </div>
             <div class="form-group row">
               <div class="col-2">รูปบัญชีธนาคาร:</div>
                <div class="col-6">
                  <a href="{{ asset('uploads/account/file/'.$reseller->bank_account_img) }}" data-lightbox="product-image">
                    <img width="100px;" src="{{ asset('uploads/account/file/'.$reseller->bank_account_img) }}" alt="">
                  </a>
                     <input type="file" class="form-control-file" id="photo-image" name="img_bank" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Please input file jpg or png.</small>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-2">บัญชีธนาคาร:</div>
               <div class="col-3">

                     <select class="form-control" name="bank_type" id="">
                       @foreach ($banks as $bank)
                          @if ($bank->id == $reseller->bank_type)
                                <option value="{{$bank->id}}" selected="">{{$bank->name}} </option>
                          @else
                                <option value="{{$bank->id}}">{{$bank->name}} </option>
                          @endif

                       @endforeach

                     </select>

               </div>
            </div>
            <div class="row form-group">
               <div class="col-2">หมายเลข :</div>
               <div class="col-4">
                    <input type="text" class="form-control" name="bank_account"
                    id="" aria-describedby="helpId" placeholder="" required="" value="{{$reseller->bank_account }}">
               </div>
            </div>

            <div class="row form-group">
               <div class="col-2">
               </div>
               <div class="col-10">
                      <input type="submit" class="btn btn-info" value="บันทึก">
                      <a href="{{url()->previous()}}" class="btn btn-warning">กลับ</a>
               </div>
            </div>

        </form>

        </div>
        {{-- end card block --}}
    </div>





    @endsection @section('user_script')

      <script src="{{asset('lightbox/js/lightbox.min.js')}}"></script>
      <link href="{{asset('lightbox/css/lightbox.min.css')}}" rel="stylesheet">

      <script>
          $( document ).ready(function() {
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
                                  $('#address-amphur').html(data);
                              },
                              error: function (data) {
                                  console.log('Error:', data);
                                  $('#product-att').html(data);
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
          });
      </script>

    @endsection
