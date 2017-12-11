@extends('layouts.app')

@section('content')


  <form method="post" action="/product/groupsave">
    {{ csrf_field() }}

                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-product-hunt"></i> ตารางราคา

                                </div>
                                <div class="card-block">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>รหัสสินค้า</th>

                                                <th>ราคาทุน</th>
                                                <th>ราคา 1</th>
                                                <th>ราคา 2</th>
                                                <th>ราคา 3</th>
                                                <th>ราคา 4</th>
                                                <th>ราคา 5</th>
                                                <th>ราคา 6</th>
                                                <th>ราคา 7</th>
                                                <th>ราคา 8</th>
                                                <th>ราคา 9</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                          @foreach($products as $product)
                                            <tr>
                                              <input type="hidden" name="product_id[]" value="{{$product->id}}">
                                              <td><a title="{{$product->product_name}}" href="/product/{{$product->id}}">{{$product->item_code}}</a></td>

                                                <td>{{ $product->base_price }}</td>
                                                <td><input name="L1[]" maxlength="4"  size="4" type="text" name="" value="{{ $product->L1 }}"></td>
                                                <td><input name="L2[]"  maxlength="4"  size="4" type="text" name="" value="{{ $product->L2 }}"></td>
                                                <td><input name="L3[]"  maxlength="4"  size="4" type="text" name="" value="{{ $product->L3 }}"></td>
                                                <td><input name="L4[]" maxlength="4"   size="4" type="text" name="" value="{{ $product->L4 }}"></td>
                                                <td><input name="L5[]"  maxlength="4"  size="4" type="text" name="" value="{{ $product->L5 }}"></td>
                                                <td><input name="L6[]" maxlength="4"   size="4" type="text" name="" value="{{ $product->L6 }}"></td>
                                                <td><input name="L7[]"  maxlength="4"  size="4" type="text" name="" value="{{ $product->L7 }}"></td>
                                                <td><input name="L8[]" maxlength="4"   size="4" type="text" name="" value="{{ $product->L8 }}"></td>
                                                <td><input name="L9[]" maxlength="4"   size="4" type="text" name="" value="{{ $product->L9 }}"></td>




                                            </tr>
                                         @endforeach

                                        </tbody>
                                    </table>
                                    <div class="form-group row">

                                        <div class="col-7 offset-5">
                                            <input name="" id="" class="btn btn-success" type="submit" value="บันทึก">
                                            <a href="{{url()->previous()}}" class="btn btn-info" role="button">กลับ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



  </form>

@endsection

@section('user_script')

<script type="text/javascript">
    $(".dosubmit").on("submit", function () {
        return confirm("ลบข้อมูลนี้?");
    });



</script>
@endsection
