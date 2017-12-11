@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>เพิ่มสินค้าใหม่

    </div>
    <div class="card-block">

      <form class="form" method="POST" action="/product">
      {{csrf_field()}}
       <input type="hidden" value="{{ $store->id }}" name="store_id">
       <input type="hidden" name="style_id" value="{{$style->id}}">
        <input type="hidden" name="category_id" value="{{$style->category->category_id}}">
             <div class="form-group row">

                 <div class="col-4"> รหัสร้านค้า/แบรนด์ : <strong>{{ $store->short_name }}</strong> </div>
                 <div class="col-4">รหัสสไตล์ : <strong>{{ $style->style_code }}</strong></div>
                 <div class="col-4">Item Style : <strong>{{ $store->short_name.$style->style_code }} </strong></div>

             </div>
             <div class="form-group row">
                 <label for="product-name" class="col-2 col-form-label">ชื่อสินค้า</label>
                 <div class="col-8">
                     <input class="form-control input-focus" type="text" value="" name="product_name" id="product-name" required>
                 </div>
             </div>
             <div class="form-group row">
                 <label for="product-name" class="col-2 col-form-label">รหัสสินค้า</label>
                 <div class="col-3">
                   <div class="input-group">
                     <span class="input-group-addon">{{ $store->short_name.$style->style_code }}</span>
                       <input type="hidden" name="item_style" value="{{ $store->short_name.$style->style_code }}">
                      <input class="form-control" type="text" value="" maxlength="3" name="product_code" id="product-code" required>
                    <span id="icon-check"></span>
                   </div>


                 </div>
             </div>
             <div class="form-group row">
                 <label for="input-price" class="col-2 col-form-label">ราคาทุน</label>
                 <div class="col-2">
                     <input class="form-control" type="text" value="0.00" id="input-price" name="base_price" required >
                 </div>
             </div>
             <div class="form-group row">
                 <label for="input-price" class="col-2 col-form-label">ราคาขาย</label>
                 <div class="col-2">
                     <input class="form-control" type="text" value="0.00" id="input-retail" name="retail_price" required >
                 </div>
             </div>
             <div class="form-group row">
                 <label for="weight" class="col-2 col-form-label">น้ำหนัก(กรัม)</label>
                 <div class="col-2">
                     <input class="form-control" type="text" value="100" id="input-weight" name="weight" required >
                 </div>
             </div>
             <div class="form-group row">
               <label for="" class="col-2 col-form-label">ประเภทสินค้า</label>
               <div class="col-2">
                   <input class="form-control" type="text" readonly value="{{ $style->category->cat_name }}" >
               </div>

             </div>
             <div class="form-group">
               <label for="">รายละเอียดสินค้า</label>
               <textarea class="form-control" name="product_desc" id="" rows="3"></textarea>
             </div>

               <div id="product-att"></div>
               <div class="form-group row">

                   <div class="col-10 offset-2">
                       <input name="" id="" class="btn btn-primary" type="submit" value="สร้าง">
                   </div>
               </div>


      </form>

    </div>
    {{-- end card block --}}
</div>





@endsection @section('user_script')
  <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>

  <script>
  tinymce.init({
    selector: 'textarea#product-desc',
    height: 300,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    content_css: '//www.tinymce.com/css/codepen.min.css'
  });


  $(document).ready(function(){

      $('#product-code').change(function(){
      //   alert($(this).val());


         $.get( "/checkitemcode/" + '{{ $store->short_name.$style->style_code }}' +$(this).val(), function( data ) {
           if (data == "1") {
               $('#icon-check').html('');
              $('#icon-check').append('<i class="fa fa-close"></i> ใช้งานไม่ได้');
           }else{
            $('#icon-check').html('') ;
             $('#icon-check').append('<i class="fa fa-check"></i> ใช้งานได้');
           }

        });
      });

  });

  </script>
@endsection
