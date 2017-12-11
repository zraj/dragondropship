@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>แก้ไข Style  : {{$style->style_code}}
    </div>
    <div class="card-block">
          <form action="/style/update/{{$style->id}}" method="post">
            {{ csrf_field() }}

            <div class="form-group row">
              <label for="style_name" class="col-2 form-control-label">รหัสไสตล์(3หลัก)</label>
              <div class="col-1 col-offset-9">
                <input type="text" name="style_code" value="{{$style->style_code}}" maxlength="3" size="3" class="form-control col-2" id="" placeholder="">
              </div>
            </div>
            <div class="form-group row">
              <label for="style_name" class="col-2 form-control-label">คำอธิบาย/รายละเอียด</label>
              <div class="col-10">
                <input type="text" name="style_desc" value="{{$style->description}}" maxlength="255" class="form-control col-2" id="" placeholder="">
              </div>
            </div>
            <div class="form-group row">
              <label for="cat_id" class="col-sm-2 form-control-label">ประเภทสินค้า</label>
              <div class="col-sm-10">
                <select class="" name="cat_id">
                  @foreach ($categories as $cat)
                      @if ($cat->category_id == $style->category_id)
                         <option selected  value="{{$cat->category_id}}">{{$cat->cat_name}}</option>
                      @else
                        <option value="{{$cat->category_id}}">{{$cat->cat_name}}</option>
                      @endif

                  @endforeach
                </select>

              </div>
            </div>


            <div class="form-group row">
              <div class="col-offset-2 col-10">
                <button type="submit" class="btn btn-secondary">แก้ไข</button>
                <a class="btn btn-info" href="{{ url()->previous() }}">กลับ</a>
              </div>
            </div>
          </form>

    </div>
        {{-- end card block --}}
    </div>
</div>





    @endsection @section('user_script')
    <script>
    </script>
    @endsection
