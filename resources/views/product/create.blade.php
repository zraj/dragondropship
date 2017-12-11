@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>New Products

    </div>
    <div class="card-block">

        <form method="POST" action="/product" enctype="multipart/form-data">
          {{ csrf_field()}}
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home">Base</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Gallery</a>
                                </li>
                                @if (auth()->user()->user_type == config('constants.admintype'))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Level</a>
                                </li>
                              @endif
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="form-group row">
                                        <label for="product-name" class="col-2 col-form-label">Product Name</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="" name="product_name" id="product-name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input-price" class="col-2 col-form-label">Price</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="0.00" id="input-price" name="base_price" required >
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label for="input-qty" class="col-2 col-form-label">Qty</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="1" id="input-qty" name="qty" required>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="input-weight" class="col-3 col-form-label">น้ำหนัก(กรัม)</label>
                                       <div class="col-9">
                                           <input class="form-control" type="text" value="100" id="input-weight" name="weight" required>

                                       </div>
                                   </div>

                                    <div class="form-group row">
                                        <label for="base-image" class="col-2 col-form-label">Base Image</label>
                                        <div class="col-10">
                                            <input type="file" class="form-control-file" id="base-image" name="base_image" aria-describedby="fileHelp">
                                            <small id="fileHelp" class="form-text text-muted">Please input file jpg for product.</small>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="product-category" class="col-2 col-form-label">Category</label>
                                        <div class="col-10">
                                            <select class="form-control" name="category_id" id="category">
                                               @foreach($category as $cat)
                                                    <option value="{{ $cat->category_id}}">{{ $cat->cat_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product-category" class="col-2 col-form-label">Store</label>
                                        <div class="col-10">
                                            <select class="form-control" name="store_id" id="category">
                                               @foreach($stores as $store)
                                                    <option value="{{ $store->id}}">{{ $store->store_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div id="product-att"></div>



                                     <div class="form-group row">
                                        <label for="product-category" class="col-2 col-form-label">Description</label>
                                        <div class="col-10">
                                             <textarea name="product_desc" id="product-desc" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    Coming Soon...
                                </div>
                                @if (auth()->user()->user_type == config('constants.admintype'))
                                  <div class="tab-pane" id="messages" role="tabpanel">
                                           <div class="form-group">

                                              <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 1</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">

                                               <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 2</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">

                                               <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 3</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">

                                              <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 4</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">

                                             <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 5</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">

                                               <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 6</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">

                                               <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 7</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">

                                               <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 8</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">

                                               <div class="controls col-5">
                                                  <div class="input-prepend input-group">
                                                      <span class="input-group-addon">Level 9</span>
                                                      <input id="appendedPrependedInput" class="form-control" size="16" type="text">
                                                      <span class="input-group-addon">.00</span>
                                                  </div>
                                              </div>
                                          </div>
                                  </div>
                                @endif

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

load_att($('#category').val());

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
