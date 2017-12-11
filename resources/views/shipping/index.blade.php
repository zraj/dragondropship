@extends('layouts.app')


@section('content')
    <div class="col-12">
      <div class="card">
            <div class="card-header">
                <strong>Shipping :</strong> การขนส่งสินค้า
            </div>
            <div class="card-block">

                   <div class="col-12 row">
                     @foreach ($shippings as $shipping)
                        <div class="col-3">
                        <div class="card">
                                <div class="card-header">
                                    {{ $shipping->name}}
                                </div>
                                <div class="card-body">
                                  <a class="btn" target="_blank" href="{{$shipping->track_url}}">Tracking</a>
                                  <a class="btn " href="/manageshipping/{{$shipping->id}}">ตารางค่าส่ง</a>
                                </div>
                            </div>

                        </div>
                     @endforeach
                   </div>






            </div>
            {{-- <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
            </div> --}}
        </div>
        {{-- end card --}}
        @if (auth()->user()->user_type == config('constants.admintype'))
       <div class="col-8 offset-2">
           <div class=" card row">
           <div class="card-header">
               Action
           </div>

           <div class="card-block">
                 <a href="/shipping/create" class="btn btn-outline-primary">เพิ่มการขนส่ง</a>


           </div>
           </div>
       </div>
     @endif
    </div>
@endsection
