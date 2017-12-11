@extends('layouts.app') @section('content')

  <div class="card">
      <div class="card-header">
          <i class="fa fa-product-hunt"></i>ยอดเงินคงเหลือ

      </div>
      <div class="card-block">

          <div class="text-center">
            <h1>ยอดเงินคงเหลือ : {{number_format(auth()->user()->cash,2)}}</h1>
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
          <table class="table table-striped">
              <thead>
                  <tr>

                  <th>รายการ</th>
                  <th>ยอดก่อนปรับ</th>
                  <th>ยอดเงิน</th>
                  <th>ยอดหลังปรับ</th>
                  <th>จากบัญชี</th>
                  <th>ไปบัญชี</th>
                  <th>สถานะ</th>
                  <th>วันที่ทำรายการ</th>
                  <th>เวลาโอน</th>
                  <th>หมายเหตุ</th>
                  </tr>
              </thead>
              <tbody>

                @foreach($data as $tran)
                  <tr>

                      <td>
                      {{$tran->trantype}}
                      @isset($tran->tran_image)
                          <a href="{{ asset('uploads/cash/slip/'.$tran->tran_image) }}" data-lightbox="product-image">
                        <img width="30px" src="{{ asset('uploads/cash/slip/'.$tran->tran_image) }}" alt="">
                      </a>
                      @endisset
                      </td>
                      <td class="text-right">{{number_format($tran->prev_balance,2)}}</td>
                      <td class="text-right">{{number_format($tran->amount,2)}}</td>
                      <td class="text-right">{{number_format($tran->cur_balance,2)}}</td>
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
                      <td>{{$tran->created_at->format('d/m/Y    H:i:s')}}</td>
                      <td>{{$tran->trantime}}</td>
                      <td>{{$tran->remarks}}</td>



                  </tr>
               @endforeach

              </tbody>
          </table>

        </div>


    </div>
    {{-- end card block --}}
</div>





@endsection @section('user_script')
  <script src="{{asset('lightbox/js/lightbox.min.js')}}"></script>
  <link href="{{asset('lightbox/css/lightbox.min.css')}}" rel="stylesheet">
<script type="text/javascript">
$(".dosubmit").on("submit", function () {
   return confirm("ลบข้อมูลนี้?");
});
</script>
@endsection
