@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>เพิ่ม Reseller(ตัวแทนขาย)
    </div>
    <div class="card-block">

        <form method="POST" action="/reseller" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row form-group">
                <div class="col-2">ชื่อตัวแทนขาย:</div>
                <div class="col-6">
                   <input type="text" class="form-control input-focus" name="name" required="">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">Login ตัวแทนขาย:</div>
                <div class="col-3">

                     <select class="form-control" name="store_owner" id="">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                     </select>

                </div>
            </div>
            <div class="row form-group">
                <div class="col-2">เบอร์โทร:</div>
                <div class="col-6">
                   <input type="text" class="form-control" name="telephone" required="">
                </div>
            </div>
            <div class="row form-group">
               <div class="col-2">รหัสไปรษณีย์:</div>
               <div class="col-2 col-offset-4">
                  <input type="text" size="5" maxlength="5" class="form-control" id="zipcode" name="postcode" required="">
               </div>
           </div>
             <div class="row form-group">
                <div class="col-2">ที่อยู่:</div>
                <div class="col-6">
                   <input type="text" class="form-control" name="address" required="">
                </div>
            </div>
            <div class="row form-group">
               <div class="col-2">แขวง/ตำบล:</div>
               <div class="col-6">
                  <input type="text" class="form-control" name="district" required="">
               </div>
           </div>
            <div class="row form-group">
               <div class="col-2">เขต/อำเภอ:</div>
               <div class="col-6">
                 <div id="address-amphur">

                 </div>
               </div>
           </div>
           <div class="row form-group">
              <div class="col-2">จังหวัด:</div>
              <div class="col-6">
                <div id="address-province">

                </div>
              </div>
           </div>
            <div class="row form-group">
              <div class="col-8">

              </div>
            </div>
            <div class="form-group row">
               <div class="col-2">รูปบัตรประชาชน:</div>
                <div class="col-6">
                     <input type="file" class="form-control-file" id="photo-image" name="id_card" aria-describedby="fileHelp" required>
                      <small id="fileHelp" class="form-text text-muted">Please input file jpg or png.</small>
               </div>
            </div>
             <div class="form-group row">
               <div class="col-2">รูปบัญชีธนาคาร:</div>
                <div class="col-6">
                     <input type="file" class="form-control-file" id="photo-image" name="img_bank" aria-describedby="fileHelp" required>
                      <small id="fileHelp" class="form-text text-muted">Please input file jpg or png.</small>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-2">ธนาคาร:</div>
               <div class="col-3">

                     <select class="form-control" name="bank_type" id="">
                       @foreach ($banks as $bank)
                            <option value="{{$bank->id}}">{{$bank->name}} </option>
                       @endforeach

                     </select>

               </div>
            </div>
            <div class="row form-group">
               <div class="col-2">หมายเลขบัญชี :</div>
               <div class="col-4">
                    <input type="text" class="form-control" name="bank_account" id="" aria-describedby="helpId" placeholder="" required="">
               </div>
            </div>

            <div class="row form-group">
               <div class="col-2">
               </div>
               <div class="col-10">
                      <input type="submit" class="btn btn-info" value="เพิ่ม">
               </div>
            </div>

        </form>

        </div>
        {{-- end card block --}}
    </div>





    @endsection @section('user_script')
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
