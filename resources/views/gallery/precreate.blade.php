@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>เพิ่มรูปสินค้า

    </div>
    <div class="card-block">

      <form class="form" method="get" action="/gallery/show">


             <div class="form-group row">

                  <div class="col-2">
                         <label for="cat_name">ร้านค้า/แบรนด์ ({{$store->store_name}}) : </label>
                  </div>
                  <div class="col-2">
                      {{$store->short_name}}
                  </div>
                  <div class="col-2">
                         <label for="cat_name">สไตล์ : </label>
                         <input type="hidden" name="store_id" value="{{$store->id}}">
                  </div>
                  <div class="col-2">
                    <select class="form-control" name="style_id">
                      @foreach ($styles as $style)
                        <option value="{{$style->id}}">{{$style->style_code}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-4">
                    <button class="btn btn-info" type="submit" name="button">สร้าง</button>
                  </div>

             </div>



      </form>

    </div>
    {{-- end card block --}}
</div>





@endsection @section('user_script')

@endsection
