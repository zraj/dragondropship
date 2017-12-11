@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i><a href="{{ url()->previous() }}">เพิ่มรูปสินค้า</a> -> สไตล์ : {{$store->short_name.$style->style_code}}

    </div>
    <div class="card-block">
    <div class="row col-12">
      @foreach($gallery as $gal)
                                                    <div class="col-3">
                                                        <div class="card">
                                                            <div class="card-block">
                                                              <a href="{{ asset('uploads/product/gallery/'.$store->short_name.$style->style_code.'/'.$gal->photo_name) }}" data-lightbox="product-image">
                                                                 <img src="{{ asset('uploads/product/gallery/'.$store->short_name.$style->style_code.'/'.$gal->photo_name) }}" alt="" width="100px;">
                                                            </a>
                                                            </div>
                                                            <div class="card-footer">
                                                                   @component('layouts.btndel',['method'=>'POST',
                                                                    'action'=>'/photo/'.$gal->id,
                                                                    'inputname'=>'id',
                                                                    'id'=> $gal->id,
                                                                    'deltext'=> '',
                                                                    'delete_tag'=> true ])
                                                                    @endcomponent
                                                            </div>
                                                        </div>
                                                    </div>


    @endforeach
    </div>

    <div class="">
        <form method="POST" id="upload-form" action="/gallery/upload" enctype="multipart/form-data">
       {{csrf_field()}}
              <div class="form-group row">
                <label for="base-image" class="col-2 col-form-label">อัพโหลดรูป</label>
                <div class="col-8">
                <input type="hidden" name="style_id" value="{{$style->id}}">
                  <input type="hidden" name="style_code" value="{{$style->style_code}}">
                  <input type="hidden" name="item_style" value="  {{$store->short_name.$style->style_code}}">

                    <input type="file" class="form-control-file" id="photo-image" name="photo_image" aria-describedby="fileHelp" required>
                    <small id="fileHelp" class="form-text text-muted">Please input file jpg for product gallery.</small>

                </div>
                <div class="col-2">
                     <input name="" id="" class="btn btn-primary" type="submit" value="upload" style="">
                </div>
            </div>
       </form>
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
