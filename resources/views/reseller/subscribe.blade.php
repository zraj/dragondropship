@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>ร้านค้าที่ {{$reseller->reseller_name}} ดูแลอยู่
    </div>
    <div class="card-block">
      @foreach ($shops->chunk(4) as $shop_chuck)
        <div class="row">
          @foreach ($shop_chuck as $shop)
            <div class="col-3">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-header">Shop : {{$shop->shop_name}}

                  </h4>
                    {{-- <span class="badge badge-pill badge-success">  เป็นตัวแทนแล้ว </span> --}}
                    <div class="container">
                      <p class="card-text">ที่อยู่ : {{$shop->address_1}}</p>
                      <p class="card-text">{{$shop->address_2}}</p>
                      <p class="card-text">Tel:{{$shop->tel_number}}</p>
                      <p class="card-text">สินค้าร้าน:{{$shop->stores->store_name}}</p>
                      <p class="card-text">ตัวแทน:{{$shop->seller->name}}</p>
                    </div>



                  <form class="dosubmit" action="/removeshop" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="reseller_id" value="{{$reseller->id}}">
                      <input type="hidden" name="input-shopid" value="{{$shop->id}}">
                      <p class="text-center">
                        <button class="btn btn-danger" type="submit" name="button">
                        ปิด Shop นี้
                        </button>
                      </p>

                  </form>


                </div>
              </div>
            </div>

          @endforeach
        </div>

      @endforeach
        @foreach ($stores->chunk(4) as $store_chuck)
          <div class="row">
            @foreach ($store_chuck as $store)
              <div class="col-3">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-header">{{$store->store_name}}</h4>

                    <p class="card-text"></p>
                    <form class="form" action="/subscribe/create" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="reseller_id" value="{{$reseller->id}}">
                        <input type="hidden" name="store_id" value="{{$store->id}}">
                        <p class="text-center">  <button class="btn btn-info text-center" type="submit" name="button">
                            สร้าง Shop จากร้านนี้
                          </button></p>

                    </form>



                  </div>
                </div>
              </div>

            @endforeach
          </div>

        @endforeach

    </div>
        {{-- end card block --}}
    </div>
</div>





    @endsection

    @section('user_script')
    <script type="text/javascript">
      $(document).ready(function(){


        $(".dosubmit").on("submit", function () {
            return confirm("ลบ shop นี้?");
        });
      });


    </script>
    @endsection
