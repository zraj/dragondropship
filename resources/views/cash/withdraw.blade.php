@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>แจ้งถอนเงิน

    </div>
    <div class="card-block">
        <div class="col-12">
              <form method="post" action="/withdraw">
                {{ csrf_field() }}


                <div class="row">
                  <div class="col-3 text-right">
                      <label for="fromaccount">เข้าบัญชี</label>
                  </div>

                    @if (auth()->user()->user_type == config('constants.resellertype'))
                      <div class="col-9">
                        <input type="hidden" name="to_bank_type" value="{{auth()->user()->reseller->banktype->id}}">
                        <input type="hidden" name="to_bank" value="{{auth()->user()->reseller->bank_account}}">
                            {{auth()->user()->reseller->banktype->name.'-'.auth()->user()->reseller->bank_account}}
                      </div>
                    @elseif (auth()->user()->user_type == config('constants.suppliertype'))
                      <div class="col-9">
                        <input type="hidden" name="to_bank_type" value="{{auth()->user()->supplier->bank_type}}">
                        <input type="hidden" name="to_bank" value="{{auth()->user()->supplier->bank_account}}">
                            {{auth()->user()->supplier->banktype->name.'-'.auth()->user()->supplier->bank_account}}
                      </div>
                    @endif

                </div>
                <div class="row">
                  <div class="col-3 text-right">
                      <label for="amount">จำนวนเงินที่จะถอน</label>
                  </div>
                  <div class="col-9">
                   <input type="text" name="amount" value="" required>
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





@endsection @section('user_script')
<script type="text/javascript">
$(".dosubmit").on("submit", function () {
   return confirm("ลบข้อมูลนี้?");
});
</script>
@endsection
