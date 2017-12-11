
<form method="POST" action="/catAttributes">
    {{csrf_field()}}

        <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Attribute to Category : </h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
            <label for="cat_name">Attribute :</label>
            <input type="hidden" value="{{ $category_id }}" name="category_id">
            <select name="attribute_id" id="">
                @foreach($attributes as $att)
                    <option value="{{ $att->attribute_id }}">{{ $att->name }}</option>
                @endforeach
            </select>
  
       </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div> 
   
</form> 