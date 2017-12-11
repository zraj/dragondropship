@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-product-hunt"></i>Print Barcode -> {{$product->item_code}}

    </div>
    <div class="card-block">

        <form method="POST" action="/barcodeproduct" >
          {{ csrf_field()}}

             <input type="hidden" name="product_id" value="{{$product->id}}">
             <input  type="hidden" name="printtype" value="A4">

             <button class="btn btn-success" type="submit" name="button">A4 Size</button>
        </form>

    </div>
    {{-- end card block --}}
</div>





@endsection @section('user_script')
@endsection
