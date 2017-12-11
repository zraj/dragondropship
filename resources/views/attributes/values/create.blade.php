<form method="POST" action="/create_att_value">
{{csrf_field()}}

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Attribute Value</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
            <label for="cat_name">{{ $att->name }} : </label>
            <input type="text" id="value_name" name="value_name" required>
            <input type="hidden"  id="attribute_id"  value="{{ $att->attribute_id }}" name="attribute_id">
       </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div> 
</form>
