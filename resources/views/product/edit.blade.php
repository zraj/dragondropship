@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>Edit Products

    </div>
    <div class="card-block">

        <form method="POST" action="/updateproduct" enctype="multipart/form-data">
          {{ csrf_field()}}
          <input type="hidden" name="product_id" value="{{$product->id}}">
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home">Base</a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="form-group row">
                                        <label for="product-name" class="col-2 col-form-label">ชื่อสินค้า</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="{{$product->product_name}}" name="product_name" id="product-name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input-price" class="col-2 col-form-label">ราคาทุน</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="{{$product->base_price}}" id="input-price" name="base_price" required >
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label for="input-qty"   class="col-2 col-form-label">จำนวน</label>
                                        <div class="col-10">
                                            <input disabled class="form-control" type="text" value="{{$product->qty}}" id="input-qty" name="qty" required>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="weight" class="col-2 col-form-label">น้ำหนัก(กรัม)</label>
                                        <div class="col-2">
                                            <input class="form-control" type="text" value="{{ $product->weight}}" id="input-weight" name="weight" required >
                                        </div>
                                    </div>
{{--
                                    <div class="form-group row">

                                        <label for="base-image" class="col-2 col-form-label">Base Image</label>
                                        <div class="col-10">
                                          <img width="100px;" height="100px;" src="{{asset('uploads/product/base_images/'.$product->base_image)}}" alt="">
                                            <input type="file" class="form-control-file" id="base-image" name="base_image" aria-describedby="fileHelp">
                                            <small id="fileHelp" class="form-text text-muted">Please input file jpg for product.</small>
                                        </div>
                                    </div> --}}


                                    <div class="form-group row">
                                        <label for="product-category" class="col-2 col-form-label">หมวดหมู่</label>
                                        <div class="col-10">
                                            <select class="form-control" name="category_id" id="category" disabled>
                                               @foreach($category as $cat)
                                                   @if ($cat->category_id == $product->style->category_id)
                                                     <option value="{{ $cat->category_id}}" selected="">{{ $cat->cat_name }}</option>
                                                   @else
                                                     <option value="{{ $cat->category_id}}">{{ $cat->cat_name }}</option>
                                                   @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product-category" class="col-2 col-form-label" >ร้านค้า/แบรนด์</label>
                                        <div class="col-10">
                                            <select class="form-control" name="store_id" id="store_id" disabled>
                                               @foreach($stores as $store)
                                                   @if ($store->id == $product->store_id)
                                                       <option value="{{ $store->id}}" selected="">{{ $store->store_name }}</option>
                                                   @else
                                                       <option value="{{ $store->id}}">{{ $store->store_name }}</option>
                                                   @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    {{-- <div id="product-att">
                                    @foreach ($product->attributes as $product_att)
                                      {{-- @foreach($product_att->attribute->attribute_parent as $att) --}}

                                      {{-- <div class="form-group row">
                                          <label for="base-image" class="col-2 col-form-label">{{$product_att->attribute->attribute_parent->name}}</label>
                                          <div class="col-10">
                                              <select name="att_value_id[]" id="att_value_id">
                                          @foreach($product_att->attribute->attribute_parent->values as $value)
                                            @if ($value->att_value_id == $product_att->att_value_id)
                                              <option value="{{$value->att_value_id}}" selected="">{{ $value->value_name}}</option>
                                            @else
                                              <option value="{{$value->att_value_id}}">{{ $value->value_name}}</option>
                                            @endif

                                          @endforeach
                                      </select>
                                          </div>


                                      </div> --}}

                                      {{-- @endforeach --}}
                                    {{-- @endforeach

                                    </div> --}}



                                     <div class="form-group row">
                                        <label for="product-category" class="col-2 col-form-label">รายละเอียด</label>
                                        <div class="col-10">
                                             <textarea name="product_desc" id="product-desc" cols="30" rows="10" >{{$product->product_desc}}</textarea>
                                        </div>
                                    </div>


                                </div>



                            </div>
                        </div>

                        <!--/.col-->
                    </div>
                    <!--/.row-->
                </div>
                <div class="form-group row">

                    <div class="col-11 offset-1">
                        <input name="" id="" class="btn btn-primary" type="submit" value="Save">
                    </div>
                </div>

            </div>
            <!-- /.conainer-fluid -->
        </form>

    </div>
    {{-- end card block --}}
    <a href="{{url()->previous()}}" class="btn btn-info" role="button">กลับ</a>
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

// load_att($('#category').val());

    $('#category').change(function(){
        load_att($(this).val());
      //  alert($(this).val());
       /*  $.ajax({

            type: "GET",
            url: "/product/dropdown_att/"+ $(this).val(),
            dataType: 'html',
            success: function (data) {
                $('#product-att').html(data);
            },
            error: function (data) {
                console.log('Error:', data);
                $('#product-att').html(data);
            }
        });*/
    });
});

function load_att($cat_id){
    $.ajax({

            type: "GET",
            url: "/product/dropdown_att/"+ $cat_id,
            dataType: 'html',
            success: function (data) {
                $('#product-att').html('');
                $('#product-att').html(data);

            },
            error: function (data) {
                console.log('Error:', data);
                $('#product-att').html(data);
            }
        });
}
</script>
@endsection
