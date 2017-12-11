@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
      <i class="icon-user"></i>ผู้ใช้งานทั้งหมด

    </div>
    <div class="card-block">

     <div class="container-fluid">

       <table class="table table-striped">
           <thead>
               <tr>
                    <th></th>
                   <th>ชื่อ</th>
                   <th>กลุ่มผู้ใช้</th>
                   <th>สร้างเมื่อ</th>
                    <th>ชื่อ login</th>
               </tr>
           </thead>
           <tbody>
              @foreach ($users as $user)
                  <tr>
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->usertypes->type_name}}</td>
                      <td>{{$user->created_at}}</td>
                      <td>{{$user->username}}</td>
                  </tr>
              @endforeach
          </tbody>
        </table>

    </div>
            <!-- /.conainer-fluid -->


    </div>
    {{-- end card block --}}
</div>





@endsection

@section('user_script')
@endsection
