@extends('layouts.app') @section('content')



<div class="card">
    <div class="card-header">
        <i class="fa fa-list-alt"></i> Attributes

    </div>
    <div class="card-block">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Attribute Name</th>
                    <th>Values</th>
                    <th>Created On</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach($attributes as $key=>$att)

                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ $att->name}}</td>
                     <td>
                     <ul style="list-style: none;">
                        @foreach($att->values as $val)
                            <li>  @component('layouts.btndel',['method'=>'POST',
                            'action'=>'/del_att_val',
                            'inputname'=>'att_value_id',
                            'id'=> $val->att_value_id,
                            'deltext'=> '',
                            'delete_tag'=>false ]) 
                              {{ $val->value_name }}
                            @endcomponent
                         </li>    
                         @endforeach
                     </ul>
                       
                     </td>

                    <td>{{ $att->created_at->diffForHumans() }}</td>
                    <td>
                        {{$att->creator->name}}
                    </td>
                    <td>
                        {{-- <button type="submit" class="btn btn-outline-info btn-sm">Edit</button> --}}

                        <form class="dosubmit" method="POST" action="/delete_att">
                            {{ csrf_field() }}
                            <input type="hidden" name="attribute_id" value="{{ $att->attribute_id }}">
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-attribute_id="{{ $att->attribute_id }}"
                                    data-target="#modal-add-value">Add Value</button>
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-attribute_id="{{ $att->attribute_id }}"
                                    data-target="#modal-edit">Edit</button>
                                <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                            </div>

                        </form>

                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>
        {{ $attributes->links('vendor.pagination.default') }}

    </div>
</div>
<div class="col-8 offset-2">
    <div class=" card row ">
        <div class="card-header">
            Action
        </div>
        <div class="card-block">


            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-add">New Attribute</button>

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

</div>
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

        <div id="load-form-add">

        </div>


    </div>
</div>
<div class="modal fade" id="modal-add-value" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

        <div id="load-add-value">

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
        var attributeId = $(e.relatedTarget).data('attribute_id');
        loadData(attributeId);
    });
    $('#modal-add').on('show.bs.modal', function (e) {
        //get data-id attribute of the clicked element

        showAddForm();
    });
     $('#modal-add-value').on('show.bs.modal', function (e) {
        //get data-id attribute of the clicked element
        var attributeId = $(e.relatedTarget).data('attribute_id');
      
        showAddValue(attributeId);
    });

    function loadData(att_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type: "GET",
            url: "/edit_att",
            data: {
                attribute_id: att_id
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
            url: "/create_att",  
            dataType: 'html',
            success: function (data) {
                $('#load-form-add').html(data);
                
            },
            error: function (data) {
                console.log('Error:', data);
                $('#load-form-add').html(data);
            }
        });
    }

     function showAddValue(att_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type: "GET",
            url: "/create_att_value",
             data: {
                attribute_id: att_id
            },
            dataType: 'html',
            success: function (data) {
                $('#load-add-value').html(data);
               
            },
            error: function (data) {
                console.log('Error:', data);
                $('#load-add-value').html(data);
            }
        });
    }
</script>
@endsection