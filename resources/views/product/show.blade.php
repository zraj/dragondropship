@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>Products Detail

    </div>
    <div class="card-block">

     <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home">ข้อมูลหลัก</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">แกลลอรี่</a>
                                </li>
                                  @if (auth()->user()->user_type == config('constants.admintype'))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Level ราคา</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#log-info" role="tab" aria-controls="log-info">ประวัติ</a>
                                </li>
                              @endif
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">

                                    <div class="row">
                                       <div class="col-6">
                                        <h3>
                                           <div class="col-10">{{ $product->item_code}}</div>

                                        </h3>

                                       </div>
                                        <div class="col-6">
                                          <h3>
                                             <div class="col-10">{{ $product->product_name}}</div>
                                          </h3>

                                          {{-- <img src="{{ asset('uploads/product/base_images/'.$product->base_image) }}" width="100%" alt=""> --}}
                                       </div>

                                    </div>
                                    <hr/>
                                    <div class="row">
                                      <label for="" class="col-2">รหัสสินค้า : </label>
                                      <div class="col-10">{{ $product->item_code}}</div>
                                   </div>
                                     <div class="row">
                                       <label for="" class="col-2">ชื่อสินค้า : </label>
                                       <div class="col-10">{{ $product->product_name}}</div>
                                    </div>
                                     <div class="row">
                                       <label for="" class="col-2">ราคาทุน : </label>
                                       <div class="col-10">{{ $product->base_price}}</div>
                                    </div>
                                    <div class="row">
                                      <label for="" class="col-2">ราคาขาย : </label>
                                      <div class="col-10">{{ $product->L1}}</div>
                                   </div>
                                    <div class="row">
                                       <label for="" class="col-2">จำนวน : </label>
                                       <div class="col-10">{{ $product->qty}}</div>
                                    </div>
                                    <div class="row">
                                       <label for="" class="col-2">น้ำหนัก(กรัม) : </label>
                                       <div class="col-10">{{ $product->weight}}</div>
                                    </div>
                                    <div class="row">
                                       <label for="" class="col-2">หมวดหมู่ : </label>
                                       <div class="col-10">{{ $product->style->category->cat_name}}</div>
                                    </div>
                                    {{-- <div class="row">

                                       <label for="" class="col-2">คุณสมบัติ : </label>
                                        <div class="col-10">
                                       @foreach($product->attributes as $p_att)
                                            {{  $p_att->attribute->attribute_parent->name.':'.$p_att->attribute->value_name.'  '}}
                                       @endforeach
                                     </div>
                                    </div> --}}
                                    <div class="row">
                                       <label for="" class="col-2">ร้านค้า/แบรนด์ : </label>
                                       <div class="col-10">{{$product->store->store_name}}</div>
                                    </div>
                                     <div class="row">
                                       <label for="" class="col-2">สร้างโดย : </label>
                                       <div class="col-10">{{$product->creator->name}}</div>
                                    </div>
                                     <div class="row">
                                       <label for="" class="col-2">สร้างเมื่อ : </label>
                                       <div class="col-10">{{$product->created_at->format('d M Y H:i:s')}}</div>
                                    </div>
                                     <div class="row">
                                       <label for="" class="col-2">อัพเดทล่าสุด : </label>
                                       <div class="col-10">{{$product->updated_at->format('d M Y H:i:s')}}</div>
                                    </div>
                                      <div class="row">
                                       <label for="" class="col-2">สถานะ : </label>
                                       <div class="col-10">
                                                @if($product->status == 0)
                                                   <span class="badge badge-danger">ยังไม่เปิดใช้งาน</span>
                                                @endif
                                                 @if($product->status == 1)
                                                   <span class="badge badge-success">ใช้งาน</span>
                                                @endif
                                       </div>
                                    </div>

                                     <div class="row">
                                       <label for="" class="col-2">รายละเอียด : </label>
                                       <div class="col-10">{!!$product->product_desc!!}</div>
                                    </div>
                                    <div class="row">
                                        @if (auth()->user()->user_type == config('constants.admintype') || auth()->user()->user_type == config('constants.suppliertype'))
                                           <a href="/editproduct/{{$product->id}}" class="btn btn-info">แก้ไข</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="row" id="gall-list">
                                      <div class="row col-12">
                                       <div class="col-4"></div>
                                       <div class="col-4">
                                         <h3>
                                          <a href="/gallery/show?store_id={{$product->store_id}}&style_id={{$product->style_id}}"> {{$product->store->short_name.$product->style->style_code}}</a>
                                         </h3>
                                       </div>
                                       <div class="col-4"></div>


                                      </div>

                                      <div class="row col-12">

                                        @foreach($gallery as $gal)
                                                                                      <div class="col-3">
                                                                                          <div class="card">
                                                                                              <div class="card-block">
                                                                                                <a href="{{ asset('uploads/product/gallery/'.$product->store->short_name.$product->style->style_code.'/'.$gal->photo_name) }}" data-lightbox="product-image">
                                                                                                   <img src="{{ asset('uploads/product/gallery/'.$product->store->short_name.$product->style->style_code.'/'.$gal->photo_name) }}" alt="" width="100px;">
                                                                                              </a>
                                                                                              </div>
                                                                                              <div class="card-footer">
                                                                                                     @component('layouts.btndel',['method'=>'POST',
                                                                                                      'action'=>'/photo/'.$gal->id,
                                                                                                      'inputname'=>'id',
                                                                                                      'id'=> $gal->id,
                                                                                                      'deltext'=> '',
                                                                                                      'delete_tag'=> true ])
                                                                                                      @endcomponent
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>


                                      @endforeach
                                      </div>

                                    </div>
                                    <div class="container">
                                        {{-- <form method="POST" id="upload-form" action="/photo" enctype="multipart/form-data">
                                       {{csrf_field()}}
                                              <div class="form-group row">
                                                <label for="base-image" class="col-2 col-form-label">Add Photos</label>
                                                <div class="col-8">
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="file" class="form-control-file" id="photo-image" name="photo_image" aria-describedby="fileHelp" required>
                                                    <small id="fileHelp" class="form-text text-muted">Please input file jpg for product gallery.</small>

                                                </div>
                                                <div class="col-2">
                                                     <input name="" id="" class="btn btn-primary" type="submit" value="upload" style="display:none;">
                                                </div>
                                            </div>
                                       </form> --}}
                                    </div>

                                </div>

                                  @if (auth()->user()->user_type == config('constants.admintype'))
                                <div class="tab-pane" id="messages" role="tabpanel">
                                  <form action="/updatelevel" method="post">
                                        {{ csrf_field() }}
                                         <div class="form-group">

                                            <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 1</span>
                                                    <input name="level1" id="appendedPrependedInput" data-validation="number" data-validation-allowing="float"
                                                     data-validation-error-msg="Please input number only" class="form-control" size="16" type="text" value="{{$product->L1}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                             <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 2</span>
                                                    <input  name="level2"id="appendedPrependedInput" data-validation="number" data-validation-error-msg="Please input number only"
                                                     data-validation-allowing="float" class="form-control" size="16" type="text" value="{{$product->L2}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                             <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 3</span>
                                                    <input name="level3" id="appendedPrependedInput" data-validation="number" data-validation-error-msg="Please input number only"
                                                     data-validation-allowing="float" class="form-control" size="16" type="text" value="{{$product->L3}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 4</span>
                                                    <input name="level4" id="appendedPrependedInput" data-validation="number" data-validation-error-msg="Please input number only"
                                                     data-validation-allowing="float" class="form-control" size="16" type="text" value="{{$product->L4}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                           <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 5</span>
                                                    <input name="level5" id="appendedPrependedInput" data-validation="number" data-validation-error-msg="Please input number only"
                                                    data-validation-allowing="float" class="form-control" size="16" type="text" value="{{$product->L5}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                             <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 6</span>
                                                    <input name="level6" id="appendedPrependedInput" data-validation="number" data-validation-error-msg="Please input number only"
                                                    data-validation-allowing="float" class="form-control" size="16" type="text" value="{{$product->L6}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                             <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 7</span>
                                                    <input name="level7" id="appendedPrependedInput" data-validation="number" data-validation-error-msg="Please input number only"
                                                     data-validation-allowing="float" class="form-control" size="16" type="text" value="{{$product->L7}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                             <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 8</span>
                                                    <input name="level8" id="appendedPrependedInput" data-validation="number" data-validation-error-msg="Please input number only"
                                                     data-validation-allowing="float" class="form-control" size="16" type="text" value="{{$product->L8}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                             <div class="controls col-5">
                                                <div class="input-prepend input-group">
                                                    <span class="input-group-addon">Level 9</span>
                                                    <input name="level9" id="appendedPrependedInput" data-validation="number" data-validation-error-msg="Please input number only"
                                                     data-validation-allowing="float" class="form-control" size="16" type="text" value="{{$product->L9}}">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                             <div class="controls col-5">
                                                 <input type="hidden" name="product_id" value="{{$product->id}}">
                                                 <input class="btn btn-info" type="submit" value="อัพเดท">
                                            </div>
                                        </div>
                                    </form>
                                    {{-- end form level --}}
                                </div>
                              @endif
                              <div class="tab-pane" id="log-info" role="tabpanel">
                                  <div class="row" id="log-info">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>TYPE</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>By</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($logs as $log)

                                                 <tr>
                                                     <td>{{$log->action}}</td>
                                                     <td>{{$log->message}}</td>
                                                     <td>{{$log->created_at->format('d M Y H:i:s')}}</td>
                                                     <td>
                                                         {{$log->creator->name}}
                                                     </td>
                                                 </tr>
                                            @endforeach

                                        </tbody>
                                    </table>


                                  </div>


                              </div>
                            </div>
                        </div>

                        <!--/.col-->
                    </div>
                    <!--/.row-->
                </div>

            </div>
            <!-- /.conainer-fluid -->


    </div>
    {{-- end card block --}}
    <a href="{{url()->previous()}}" class="btn btn-info" role="button">กลับ</a>
</div>





@endsection

@section('user_script')
<script type="text/javascript">

$(document).ready(function (e) {
    $('#upload-form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                console.log(data);
                showgal();
                 $("#photo-image").val('');
            },
            error: function(data){
                console.log("error");
             //   console.log(data);
            }
        });
    }));

    $("#photo-image").on("change", function() {
        $("#upload-form").submit();
    });

     $(".dosubmit").on("submit", function () {
        return confirm("ลบข้อมูลนี้?");
    });
});

function showgal(){

      $.ajax({
            type:'GET',
            url:'/photo/'+ {{$product->id}},
            success:function(data){
                console.log("success");
               $('#gall-list').html('');
               $('#gall-list').html(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });

}


</script>


<script src="{{asset('lightbox/js/lightbox.min.js')}}"></script>
<link href="{{asset('lightbox/css/lightbox.min.css')}}" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
 $.validate({
    lang: 'en'
  });
</script>
@endsection
