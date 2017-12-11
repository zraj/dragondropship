@extends('layouts.app') @section('content')




    <div class="container-fluid col-sm-10">

                         <div class="card" id="shopapp">
                             <div class="card-header">
                                 <strong>Shop</strong>
                                 <small>@{{shop_name}}</small>
                             </div>

                               <div class="card-body">
                                <div class="container" style="width:380px;">
                                  <br>
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <div class="card text-black  text-center">
                                              <div class="card-body">
                                                <div class="container">
                                                      <p class="text-left"><strong>@{{shop_name}}</strong></p>
                                                      <p class="text-left">@{{address1}}</p>
                                                      <p class="text-left">@{{address2}}</p>
                                                      <p class="text-left">Tel : @{{mobile}}</p>
                                                 </div>

                                              </div>
                                          </div>
                                      </div>

                                  </div>

                                </div>
                                  <form class="form-control" action="/createshop" method="post" >
                                    {{ csrf_field() }}
                                    <input type="hidden" name="input-storeid" value="{{$store->id}}">
                                    <input type="hidden" name="input-resellerid" value="{{$reseller->id}}">
                                    <div class="form-group">
                                        <label for="street">สินค้าร้าน : {{$store->store_name}}</label>

                                    </div>
                                   <div class="form-group">
                                       <label for="company">Name</label>
                                       <input name="input-shopname" type="text" maxlength="40" required v-model="shop_name" class="form-control input-focus" id="company" placeholder="Enter your shop name">
                                   </div>

                                   <div class="form-group">
                                       <label for="vat">Address Line 1</label>
                                       <input name="input-address1" type="text" maxlength="40" required  v-model="address1" class="form-control" id="vat" placeholder="">
                                   </div>
                                   <div class="form-group">
                                       <label for="vat">Address Line 2</label>
                                       <input name="input-address2" type="text" maxlength="40" required  v-model="address2" class="form-control" id="vat" placeholder="">
                                   </div>

                                   <div class="form-group">
                                       <label for="street">Mobile</label>
                                       <input name="input-mobile" type="text" maxlength="12"  v-model="mobile" class="form-control" id="street" placeholder="">
                                   </div>

                                   <div class="row">
                                     <div class="form-group col-sm-4">
                                         <label for="street">Seller</label>
                                        <select class="form-control" name="input-seller">
                                          @foreach ($sellers as $seller)
                                                  <option value="{{$seller->id}}">{{$seller->name}}</option>
                                          @endforeach

                                        </select>
                                     </div>
                                   </div>

                                   <div class="form-group">
                                      <button type="submit" class="btn btn-success" name="button">Create</button>
                                   </div>




                                   {{-- <div class="row">

                                       <div class="form-group col-sm-8">
                                           <label for="city">City</label>
                                           <input type="text" class="form-control" id="city" placeholder="Enter your city">
                                       </div>

                                       <div class="form-group col-sm-4">
                                           <label for="postal-code">Postal Code</label>
                                           <input type="text" class="form-control" id="postal-code" placeholder="Postal Code">
                                       </div>

                                   </div>
                                   <!--/.row-->

                                   <div class="form-group">
                                       <label for="country">Country</label>
                                       <input type="text" class="form-control" id="country" placeholder="Country name">
                                   </div> --}}
                                   </form>
                               </div>


                         </div>

                     </div>






    @endsection

    @section('user_script')
    <script type="text/javascript">
     var shopapp = new Vue({
       el:'#shopapp',
       data : {
         shop_name :'ชื่อร้าน',
         address1 : 'Address Line 1',
         address2: 'Address Line 2',
         mobile : '-'
       }
    });
    </script>
    @endsection
