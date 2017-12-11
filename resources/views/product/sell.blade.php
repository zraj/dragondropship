@extends('layouts.app')

@section('content')


<div class="">
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
          <table class="table table-striped" id="productcart">
              <thead>
                  <tr>

                  <th>รหัสสินค้า</th>
                      <th>ชื่อสินค้า</th>

                      <th>จำนวนที่มี</th>
                      <th>ร้านค้า/แบรนด์</th>
                      <th>หมวดหมู่</th>
                      <th>ราคาส่ง</th>

                       <th></th>
                  </tr>
              </thead>
              <tbody>

                @foreach($products as $product)
                  <tr>

                    <td><a href="/product/{{$product->id}}">{{$product->item_code}}</a></td>
                     <td>{{$product->product_name}}</td>

                      <td>{{ $product->qty }}</td>

                      <td>{{$product->store->store_name}}</td>
                        <td>{{ $product->style->category->cat_name }}</td>
                      <td>{{ $product->L1 }}</td>


                      <td>
                      <div class="col-12">

                            <div class="col-6">
                               {{-- <button type="button"  class="btn btn-success" v-on:click="addItem">
                                   เพิ่มลงตะกร้า
                               </button> --}}
                               <button type="button" @click="updatename('{{$product->product_name}}')" class="btn btn-outline-info btn-sm" data-toggle="modal" data-id="{{$product->id}}"
                                data-target="#modal-attribute">
                                   เพิ่มลงตะกร้า
                                </button>
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

      </div>
      <div class="">

           <br>
           <br>
           <br>
           <br>
      </div>
  </div>

</div>







@endsection


<div class="modal fade" id="modal-attribute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

        <div id="load-form-att">
          <div class="card" style="width: 20rem;">

  <div class="card-block">
    <h4 class="card-title">เพิ่มสินค้าไปที่ตะกร้าสินค้า</h4>
    <form id="formadd">
      <fieldset class="form-group">
        {{-- <label for="formGroupExampleInput">สินค้า</label> --}}
        <input type="text" disabled class="form-control" id="product_name" v-model="productname" >
        <input type="hidden" disabled class="form-control" id="product-id" v-bind="productid" >
      </fieldset>
      <fieldset class="form-group">
        <label for="formGroupExampleInput2">จำนวน</label>
        <input type="text" class="form-control" id="formGroupExampleInput2" v-model="productqty" placeholder="" value="1">
      </fieldset>
      <fieldset class="form-group">
        <button type="button"  class="btn btn-success" @click="add">
            เพิ่มลงตะกร้า
        </button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </fieldset>
    </form>
  </div>
</div>

        </div>


    </div>
</div>

@section('user_script')

<script type="text/javascript">


$('#modal-attribute').on('show.bs.modal', function (e) {
 //get data-id attribute of the clicked element
   var productId = $(e.relatedTarget).data('id');
   $('#product-id').val(productId);

});

var csrf_token = $('meta[name="csrf-token"]').attr('content');

var app4 = new Vue({
   el:'#formadd',
   data:{
       productid : 0,
       productqty : 1,
       productname :'',
   },
   methods:{
     add(){
       this.productid = $('#product-id').val();
       app3.addItem();
      //  $('#modal-attribute').hide();
       $('#modal-attribute').modal('hide');
     }
   }

});

var app3 = new Vue({
  el:'#productcart',
  data:{
    productname:''
  },
  methods:{
     addItem(){
       axios.post('/addcart', {
          productId: app4.productid,
          qty: app4.productqty,
          token:csrf_token,

        })
        .then(function (response) {

          if (response.data == true) {
             app2.getCart();
          }else{
            alert('Error Add Item');
          }
          console.log(response);
        })
        .catch(function (error) {
          alert('Error Add Item(catched)');
          console.log(error);
        });

     },
     updatename : function(data){
        app4.productname = data;
     }

  }
});

</script>
@endsection
