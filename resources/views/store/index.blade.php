@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>ร้านค้า ทั้งหมด
    </div>
    <div class="card-block">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>ชื่อร้าน/แบรนด์</th>
            <th>รหัสร้านค้า</th>
            <th>Supplier</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
              @foreach ($stores as $store)
                <tr>
                  <td>{{$loop->index +1 }}</td>
                  <td><a href="/productgroup/{{$store->id}}">{{$store->store_name}}</a></td>
                  <td>{{$store->short_name}}</td>
                  <td>{{$store->supplier->supplier_name}}</td>
                  <td>
                    @if (auth()->user()->user_type == config('constants.admintype'))
                      <a href="/product/precreate/{{$store->id}}" class="btn btn-info">เพิ่มสินค้า</a>
                      <a href="/store/edit/{{$store->id}}" class="btn btn-info">ดู/แก้ไข</a>
                    @endif

                      <a href="/gallery/create/{{$store->id}}" class="btn btn-info">เพิ่มรูป</a>
                  </td>
                </tr>


              @endforeach
        </tbody>
      </table>

    </div>
        {{-- end card block --}}
    </div>
</div>





    @endsection @section('user_script')
    <script>
    </script>
    @endsection
