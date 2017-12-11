@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>Reseller ทั้งหมด
    </div>
    <div class="card-block">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>ชื่อตัวแทน</th>
            <th>Login ตัวแทน</th>
            <th>Telephone</th>
            <th>ร้านค้าที่เป็นตัวแทน</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
              @foreach ($resellers as $reseller)
                <tr>
                  <td>{{$loop->index +1 }}</td>
                  <td>{{$reseller->reseller_name}}</td>
                  <td>{{$reseller->owner->name}}</td>
                  <td>{{$reseller->telephone}}</td>
                  <td></td>
                  <td>
                    <a href="/reseller/{{$reseller->id}}" class="btn btn-info">ดู/แก้ไข</a>
                    <a href="/subscribe/{{$reseller->id}}" class="btn btn-info">เลือกร้านค้า</a>
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
