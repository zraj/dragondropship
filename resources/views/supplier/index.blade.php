@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>Supplier ทั้งหมด
    </div>
    <div class="card-block">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>ชื่อร้านค้า/บริษัท</th>
            <th>เจ้าของร้าน</th>
            <th>Telephone</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
              @foreach ($suppliers as $supplier)
                <tr>
                  <td>{{$loop->index +1 }}</td>
                  <td><a href="/storegroup/{{$supplier->id}}">{{$supplier->supplier_name}}</a></td>
                  <td>{{$supplier->owner->name}}</td>
                  <td>{{$supplier->telephone}}</td>
                  <td>
                    <a href="supplier/{{$supplier->id}}" class="btn btn-info">ดู/แก้ไข</a>
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
