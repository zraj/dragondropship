@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>แก้ไขร้านค้า
    </div>
      <div class="card-block">

        <form method="POST" action="/store/update/{{$store->id}}">
            {{csrf_field()}}
            <div class="row form-group">
               <div class="col-2">ชื่อร้าน/แบรนด์:</div>
               <div class="col-6">
                  <input type="text" class="form-control input-focus" value="{{$store->store_name}}" name="store-name" required="">
               </div>
           </div>
           <div class="row form-group">
              <div class="col-2">รหัสร้านค้า(ตัวอักษร A-Z จำนวน 2 หลัก เช่น AB,AC):</div>
              <div class="col-1 col-offset-9">
                 <input type="text" maxlength="2" value="{{$store->short_name}}" class="form-control" name="short-name" required="">
              </div>
          </div>

          <div class="row form-group">
             <div class="col-2">supplier:</div>
             <div class="col-6">
               <select class="form-control" name="input-supplier">
                 @foreach ($suppliers as $supplier)
                   @if ($supplier->id == $store->supplier_id)
                     <option value="{{$supplier->id}}" selected>{{$supplier->supplier_name}}</option>
                   @else
                     <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                   @endif

                 @endforeach
               </select>

             </div>
         </div>
         <div class="row form-group">
            <div class="col-2">การขนส่งที่สามารถ:</div>
            <div class="col-6">
              @foreach ($canship as $shipping)

                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input name="input-shipping[]" checked class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{$shipping->id}}">   {{$shipping->name}}
                  </label>
                </div>
              @endforeach
              @foreach ($cantship as $shipping)

                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input name="input-shipping[]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{$shipping->id}}">   {{$shipping->name}}
                  </label>
                </div>
              @endforeach




            </div>
        </div>

            <div class="row form-group">
               <div class="col-2">
               </div>
               <div class="col-10">
                      <input type="submit" class="btn btn-info" value="บันทึก">
               </div>
            </div>

        </form>

        </div>
        {{-- end card block --}}
    </div>





    @endsection @section('user_script')
    <script>

    </script>
    @endsection
