@extends('layouts.app') @section('content')

  <div class="card">
      <div class="card-header">
          <i class="fa fa-product-hunt"></i>ยอดเงินคงเหลือ

      </div>
      <div class="card-block">

          <div class="text-center">
            <h1>ยอดเงินคงเหลือ : {{number_format(auth()->user()->getbalance(),2)}}</h1>
          </div>

      </div>
      {{-- end card block --}}
  </div>

<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>การเงิน

    </div>
    <div class="card-block">
        <div class="col-12">
          <table class="table table-responsive table-striped">
              <thead>
                  <tr>
                  <th>เจ้าของรายการ</th>
                  <th>รายการ</th>
                  <th>ยอดเงิน</th>
                  <th>จากบัญชี</th>
                  <th>ไปบัญชี</th>
                  <th>สถานะ</th>
                  <th>วันที่ทำรายการ</th>
                  <th>เวลาโอน</th>
                  <th>หมายเหตุ</th>
                  <th></th>
                  </tr>
              </thead>
              <tbody>

                @foreach($data as $tran)
                  <tr>
                      <td>
                        <a href="/viewprofile/{{$tran->owner}}">{{$tran->tran_owner->name}}</a>

                      </td>
                      <td>
                      {{$tran->trantype}}
                      @isset($tran->tran_image)
                          <a href="{{ asset('uploads/cash/slip/'.$tran->tran_image) }}" data-lightbox="product-image">
                        <img width="30px" src="{{ asset('uploads/cash/slip/'.$tran->tran_image) }}" alt="">
                      </a>
                      @endisset
                      </td>
                      <td class="text-right">{{number_format($tran->amount,2)}}</td>
                      <td>
                        @isset($tran->frombank)
                          {{$tran->frombank->name.'-'.$tran->from_bank}}
                        @endisset
                      </td>
                       <td>
                         @isset($tran->tobank)
                              {{$tran->tobank->name.'-'.$tran->to_bank}}
                         @endisset

                       </td>
                      <td>
                        @if ($tran->status == 0)
                        <span class="badge badge-pill badge-info">  รออนุมัติ </span>
                        @elseif ($tran->status == 1)
                        <span class="badge badge-pill badge-success">  เรียบเรียบแล้ว </span>
                        @elseif ($tran->status == 2)
                        <span class="badge badge-pill badge-danger">  ยกเลิกรายการ </span>
                        @endif
                      </td>
                      <td>{{$tran->created_at->format('d/m/Y  h:i:s')}}</td>
                      <td>{{$tran->trantime}}</td>
                      <td>{{$tran->remarks}}</td>
                      <td>
                        {{-- <div class="col-6">
                          <form class="" action="/approvecash" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="tranid" value="{{$tran->id}}">
                              <input class="btn btn-success" type="submit" name="" value="อนุมัติ">
                          </form>
                        </div>
                        <div class="col-6">
                          <form class="" action="/rejectcash" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="tranid" value="{{$tran->id}}">
                              <input class="btn btn-danger" type="submit" name="" value="ยกเลิก">
                          </form>
                        </div> --}}

                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @component('layouts.btnapprove',['method'=>'POST',
                              'action'=>'/approvecash/'.$tran->id,
                              'inputname'=>'id',
                              'id'=> $tran->id,
                              'btntext'=> 'อนุมัติรายการ',
                              'delete_tag'=> false,
                              'class' => 'dosubmit btn-info' ])
                              @endcomponent
                           @component('layouts.btndel',['method'=>'POST',
                             'action'=>'/rejectcash/'.$tran->id,
                             'inputname'=>'id',
                             'id'=> $tran->id,
                             'deltext'=> 'ยกเลิกรายการ',
                             'delete_tag'=> false,
                             'class' => 'dosubmit btn-danger' ])
                             @endcomponent
                          </div>
                        </div>


                      </td>



                  </tr>
               @endforeach


              </tbody>
          </table>
            <br>
            <br>
            <br>
            <br>
        </div>


    </div>
    {{-- end card block --}}
</div>





@endsection @section('user_script')
  <script src="{{asset('lightbox/js/lightbox.min.js')}}"></script>
  <link href="{{asset('lightbox/css/lightbox.min.css')}}" rel="stylesheet">
<script type="text/javascript">
$(".dosubmit").on("submit", function () {
   return confirm("ยกเลิกรายการ ?");
});
$(".doapprove").on("submit", function () {
   return confirm("อนุมัติรายการ ?");
});
</script>
@endsection
