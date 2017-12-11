@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>แจ้งฝากเงิน

    </div>
    <div class="card-block">
        <div class="col-12">
              <form method="post" action="/deposit" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-3 text-right">
                      <label for="bankaccount">ธนาคารที่จะฝากเข้าระบบ</label>
                  </div>
                  <div class="col-9">
                    <select class="" name="bankaccount">
                         @foreach ($banks as $bank)
                           <option value="{{ $bank->id}}">{{$bank->banktype->name}} เลขที่ {{ $bank->bank_number}} - ({{$bank->account_name}})</option>
                         @endforeach

                    </select>
                  </div>


                </div>
                <div class="row">
                  <div class="col-3 text-right">
                      <label for="frombank">จากธนาคาร</label>
                  </div>
                  <div class="col-9">
                    <select class="" name="frombank">
                      @foreach ($bankacc as $acc)
                        <option value="{{$acc->id}}">{{$acc->name}}</option>
                      @endforeach

                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3 text-right">
                      <label for="fromaccount">เลขที่</label>
                  </div>
                  <div class="col-9">
                   <input type="text" name="fromaccount" value="" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3 text-right">
                      <label for="amount">จำนวนเงินที่ฝากเข้า</label>
                  </div>
                  <div class="col-9">
                   <input type="text" name="amount" value="" required>
                  </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <label for="photo_image">แนบไฟล์รูปหลักฐานการโอนเงิน</label>
                    </div>
                    <div class="col-9">
                      <input type="file" class="form-control-file" id="photo-image" name="photo_image" aria-describedby="fileHelp" required>
                      <small id="fileHelp" class="form-text text-muted">แนบไฟล์รูปหลักฐานการโอนเงิน</small>
                    </div>
                </div>
                <div class="row">
                  <div class="col-3 text-right">เวลาโอน</div>
                  <div class="col-3 text-right">

                              <div class="form-group">

                                  <div class='input-group date' >
                                       <span class="input-group-addon">เวลา</span>
                                       <input type='text' name="time"
                                        class="form-control" id='datetimepicker4' required=""/>

                                  </div>
                              </div>


                  </div>

                </div>

                <div class="row">
                    <div class="col-3 text-right">
                        <label for="photo_image">หมายเหตุ</label>
                    </div>
                    <div class="col-9">
                       <input type="text" name="remarks" value="">
                    </div>
                </div>
                <div class="row">
                     <div class="col-3">

                     </div>
                     <div class="col-9">
                         <input class="btn btn-success" type="submit" name="" value="ตกลง">
                     </div>
                </div>
              </form>

        </div>


    </div>
    {{-- end card block --}}
</div>





@endsection
@section('user_script')

     <script type="text/javascript" src="{{asset('/bower_components/moment/min/moment.min.js')}}"></script>
     <script type="text/javascript" src="{{asset('/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
     <link rel="stylesheet" href="{{asset('/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />

    <script type="text/javascript">
        $(function () {
              $('#datetimepicker4').datetimepicker({
                      format: 'H:mm'
              });
              $('#datetimepicker3').datetimepicker({
                      format: 'D-MM-Y'
              });
          });
    </script>
<script type="text/javascript">
$(".dosubmit").on("submit", function () {
   return confirm("ลบข้อมูลนี้?");
});
</script>
@endsection
