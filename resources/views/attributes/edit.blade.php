<form method="POST" action="/edit_att">
{{csrf_field()}}
  <input type="hidden" id="attribute_id" name="attribute_id" value="{{$attribute->attribute_id}}">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Attribute ({{$attribute->attribute_id}}) : {{ $attribute->name }}</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
            <label for="cat_name">Attribute name : </label>
            <input type="text" id="name" name="name" value="{{ $attribute->name }}" required>
       </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div> 
</form>


