@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>เพิ่ม Style - > ร้านค้า
    </div>
    <div class="card-block">
      <div id="accordion" role="tablist">
        @foreach ($stores as $store)
          <div class="card">
           <div class="card-header" role="tab" id="headingOne">
             <h5 class="mb-0">
               <a data-toggle="collapse" href="#store{{$store->id}}" aria-expanded="true" aria-controls="collapseOne">
                 {{$store->store_name}}
               </a>

             </h5>
           </div>

           <div id="store{{$store->id}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
             <div class="card-block">

               <ul>
                  @foreach ($store->styles as $style)
                    <li><a href="/style/edit/{{$style->id}}">{{$style->style_code}} - {{ $style->description }}</a></li>
                  @endforeach

               </ul>
                <a href="/style/create/{{$store->id}}" class="btn btn-info">เพิ่มสไตล์ใหม่</a>

             </div>
           </div>
          </div>
        @endforeach

      </div>
      {{-- end accordion --}}

    </div>
        {{-- end card block --}}
    </div>
</div>





    @endsection @section('user_script')
    <script>
    </script>
    @endsection
