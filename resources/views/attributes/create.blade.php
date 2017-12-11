<form method="POST" action="/create_att">
{{csrf_field()}}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Attribute</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
            <label for="cat_name">Attribute Name : </label>
            <input type="text" id="name" name="name" required>
       </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div> 
</form>

