@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-list-alt"></i> กลุ่มสินค้า

    </div>
    <div class="card-block">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>กลุ่มสินค้า</th>
                    <th>รหัสกลุ่ม</th>
                    <th>คุณสมบัติ</th>
                    <th>สร้างเมื่อ</th>
                    <th>สร้างโดย</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach($categories as $key=>$cat)

                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ $cat->cat_name}}</td>
                    <td>{{$cat->cat_code}}</td>
                    <td>
                        <ul style="list-style: none;">
                        @foreach($cat->attributes as $val)
                            <li>  @component('layouts.btndel',['method'=>'POST',
                            'action'=>'/catAttributes/'.$val->id,
                            'inputname'=>'id',
                            'id'=> $val->id,
                            'deltext'=> '',
                            'delete_tag'=> true ])
                              {{ $val->attribute->name }}
                            @endcomponent
                         </li>
                         @endforeach
                     </ul>
                    </td>

                    <td>{{ $cat->created_at->diffForHumans() }}</td>
                    <td>
                        {{$cat->creator->name}}
                    </td>
                    <td>
                        {{-- <button type="submit" class="btn btn-outline-info btn-sm">Edit</button> --}}

                        <form class="dosubmit" method="POST" action="/delete_cat">
                            {{ csrf_field() }}
                            <input type="hidden" name="category_id" value="{{ $cat->category_id }}">
                            <div class="form-group">

                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-category_id="{{ $cat->category_id }}"
                                    data-target="#modal-attribute">เพิ่มคุณสมบัติ</button>
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-category_id="{{ $cat->category_id }}"
                                    data-target="#modal-edit">แก้ไข</button>
                                <button type="submit" class="btn btn-outline-info btn-sm">
                                                                       <i class="fa fa-trash" aria-hidden="true"></i> ลบ
                                                                      </button>
                            </div>

                        </form>

                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>
        {{ $categories->links('vendor.pagination.default') }}

    </div>
</div>
<div class="col-8 offset-2">
    <div class=" card row ">
        <div class="card-header">
            Action
        </div>
        <div class="card-block">


            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-cat_name="Not2Much Short Pant" data-category_id="1"
                data-target="#modal-add">เพิ่มกลุ่มสินค้าใหม่</button>

        </div>
    </div>
</div>


@endsection



<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

        <div id="load-data">

        </div>


    </div>
</div>


<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

        <div id="load-form-add">

        </div>


    </div>
</div>


<div class="modal fade" id="modal-attribute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

        <div id="load-form-att">

        </div>


    </div>
</div>


@section('user_script')
<script type="text/javascript">
    $(".dosubmit").on("submit", function () {
        return confirm("ลบข้อมูลนี้?");
    });
</script>


<script>
    $('#modal-edit').on('show.bs.modal', function (e) {
        //get data-id attribute of the clicked element
        var categoryId = $(e.relatedTarget).data('category_id');
        loadData(categoryId);
    });
    $('#modal-add').on('show.bs.modal', function (e) {
        //get data-id attribute of the clicked element

        showAddForm();
    });

       $('#modal-attribute').on('show.bs.modal', function (e) {
        //get data-id attribute of the clicked element
          var categoryId = $(e.relatedTarget).data('category_id');
        showAttributeForm(categoryId);
    });

function showAttributeForm(cat_id){

        $.ajax({

            type: "GET",
            url: "/catAttributes/create",
            data: {
                category_id: cat_id
            },
            dataType: 'html',
            success: function (data) {
                $('#load-form-att').html(data);
            },
            error: function (data) {
                console.log('Error:', data);
                $('#load-form-att').html(data);
            }
        });
}

    function loadData(cat_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type: "POST",
            url: "/display_cat",
            data: {
                category_id: cat_id
            },
            dataType: 'html',
            success: function (data) {
                $('#load-data').html(data);
            },
            error: function (data) {
                console.log('Error:', data);
                $('#load-data').html(data);
            }
        });
    }

    function showAddForm() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type: "GET",
            url: "/create_cat",
            dataType: 'html',
            success: function (data) {
                $('#load-form-add').html(data);
                $('#cat_name').focus();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#load-form-add').html(data);
            }
        });
    }
</script>
@endsection
