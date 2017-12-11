@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>เพิ่มสินค้าใหม่

    </div>
    <div class="card-block">

      <form class="form dosubmit" method="POST" action="/adjustqty">
      {{csrf_field()}}

             <div class="form-group row">

                  <div class="col-4">
                         <label for="cat_name">สินค้า ({{$product->item_code}}) : {{$product->product_name}} </label>
                         <input type="hidden" name="product_id" value="{{$product->id}}">
                  </div>

                  <div class="col-2">
                         <label for="cat_name">ต้องการ : </label>
                         <select class="" name="adjust_type">
                             <option value="1">เพิ่มจำนวน</option>
                             <option value="2">ลดจำนวน</option>
                         </select>
                  </div>
                  <div class="col-2">
                     <input type="text" class="input-focus" id="qty" name="qty" value="">
                  </div>
                  <div class="col-4">
                    <button class="btn btn-info" type="submit" name="button">ตกลง</button>
                  </div>

             </div>



      </form>

    </div>
    {{-- end card block --}}
</div>





@endsection @section('user_script')
  <script type="text/javascript">
  $(".dosubmit").on("submit", function () {
    // alert($('#qty').val());
    if ($('#qty').val() == '0' || $('#qty').val() == '') {
      alert('กรุณากรอกจำนวน');
      return false;
    }else {
      return confirm("ยืนยัน?");
    }


  });
  </script>

@endsection
