@extends('layouts.app')

@section('content')


<div class="col-11">
  <div class="card">
      <div class="card-header">
          <i class="fa fa-product-hunt"></i> Products

      </div>
      <div class="card-block">
        <form class="" action="/searchproduct" method="post">
            {{ csrf_field() }}
            <input class="form-control input-focus" type="text" name="input-search" value="">
            <input type="submit" name="" value="OK" style="display:none">
        </form>

        <hr>
          <table class="table table-striped table-responsive" >
              <thead>
                  <tr>
                  <th></th>
                  <th>รหัสสินค้า</th>
                      <th>ชื่อสินค้า</th>

                      <th>จำนวน</th>
                      <th>ร้านค้า/แบรนด์</th>
                      <th>หมวดหมู่</th>
                      <th>ราคาทุน</th>
                      <th>ราคา 1</th>
                      <th>ราคา 2</th>
                      <th>ราคา 3</th>
                      <th>ราคา 4</th>
                      <th>ราคา 5</th>
                      <th>ราคา 6</th>
                      <th>ราคา 7</th>
                      <th>ราคา 8</th>
                      <th>ราคา 9</th>
                       {{-- <th>สถานะ</th> --}}
                       <th></th>
                  </tr>
              </thead>
              <tbody>

                @foreach($products as $product)
                  <tr>
                  <td>
                      {{-- @if(isset($product->base_image))

                          <img src="{{ asset('uploads/product/base_images/'.$product->base_image) }}" width="70px"  class="img-thumbnail" alt="">
                      @endif --}}
                      <input type="checkbox" class="cbx-edit" name="cbx-edit" value="{{$product->id}}">
                  </td>
                    <td><a href="/product/{{$product->id}}">{{$product->item_code}}</a></td>
                     <td>{{$product->product_name}}</td>

                      <td>{{ $product->qty }}</td>

                      <td>{{$product->store->store_name}}</td>
                        <td>{{ $product->style->category->cat_name }}</td>
                      <td>{{ $product->base_price }}</td>
                      <td>{{ $product->L1 }}</td>
                      <td>{{ $product->L2 }}</td>
                      <td>{{ $product->L3 }}</td>
                      <td>{{ $product->L4 }}</td>
                      <td>{{ $product->L5 }}</td>
                      <td>{{ $product->L6 }}</td>
                      <td>{{ $product->L7 }}</td>
                      <td>{{ $product->L8 }}</td>
                      <td>{{ $product->L9 }}</td>
                      {{-- <td>{{ $product->created_at->format('F d, Y H:i:s') }}</td> --}}
                      {{-- <td>{{ $product->creator->name }}</td> --}}
                      {{-- <td>
                      @if($product->status == 0)
                         <span class="badge badge-danger">ยังไม่เปิดใช้งาน</span>
                      @endif
                       @if($product->status == 1)
                         <span class="badge badge-success">ใช้งาน</span>
                      @endif
                      </td> --}}
                      <td>
                      <div class="col-12">

                            <div class="col-6">
                              <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a name="" id="" class="btn btn-info dropdown-item"   href="/product/{{$product->id}}" role="button">ดูสินค้า</a>
                                  <a name="" id="" class="btn btn-info dropdown-item" target="_blank"  href="/barcodeproduct/{{$product->id}}" role="button">บาร์โค๊ด</a>
                                  <a name="" id="" class="btn btn-info dropdown-item" target="_blank"  href="/productqty/{{$product->id}}" role="button">จำนวนสินค้า</a>
                                  @component('layouts.btndel',['method'=>'POST',
                                   'action'=>'/product/'.$product->id,
                                   'inputname'=>'id',
                                   'id'=> $product->id,
                                   'deltext'=> 'Delete',
                                   'delete_tag'=> true,
                                   'class' => 'btn-danger' ])
                                   @endcomponent
                                </div>
                              </div>
                          </div>
                          <div class="col-6">

                          </div>
                      </div>


                      </td>
                  </tr>
               @endforeach

              </tbody>
          </table>
               {{ $products->links('vendor.pagination.default') }}
          {{-- <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Prev</a>
              </li>
              <li class="page-item active">
                  <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">2</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">4</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">Next</a>
              </li>
          </ul> --}}
      </div>
      <div class="">
           <br>
           <br>
           <br>
           <br>
      </div>
  </div>

</div>


                             @if (auth()->user()->user_type == config('constants.admintype') || auth()->user()->user_type == config('constants.suppliertype'))
                            <div class="col-8 offset-2">
                                <div class=" card row">
                                <div class="card-header">
                                    Action
                                </div>

                                <div class="card-block">
                                      <a href="/store" class="btn btn-outline-primary">เพิ่มสินค้าใหม่</a>
                                    <a href="#" id="btn-edit-group" class="btn btn-outline-primary">แก้ไขตารางราคา</a>
                                    {{-- <a href="/category" class="btn btn-outline-primary">Category</a>
                                    <a href="/attribute" class="btn btn-outline-primary">Attribute</a> --}}

                                </div>
                                </div>
                            </div>
                          @endif


                          <form id="form-edit-group" method="post" action="/product/groupedit">
                             {{ csrf_field() }}

                          </form>

@endsection

@section('user_script')

<script type="text/javascript">
    $(".dosubmit").on("submit", function () {
        return confirm("ลบข้อมูลนี้?");
    });

    $('#btn-edit-group').click(function(){
       if($('.cbx-edit:checked').length != 0){
         $('.cbx-edit:checked').each(function(){
          //   alert($(this).val());
             $('#form-edit-group').append('<input name="product_id[]" type="hidden" value="'+ $(this).val() +'">');
         });
         $('#form-edit-group').submit();
       }

    });

</script>
@endsection
