<form method="POST" action="/edit_cat">
{{csrf_field()}}
  <input type="hidden" id="category_id" name="category_id" value="{{$category->category_id}}">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">แก้ไขกลุ่มสินค้า : {{ $category->cat_name }}</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
            <label for="cat_name">ชื่อกลุ่มสินค้า : </label>
            <input type="text" id="cat_name" name="cat_name" value="{{ $category->cat_name }}" required>
       </div>
       <div class="form-group">
            <label for="cat_name">รหัสกลุ่มสินค้า (ตัวเลขสองหลัก เช่น 01 , 02) : </label>
            <input type="text" maxlength="2" size="2" id="cat_code" name="cat_code" value="{{ $category->cat_code }}" required>
       </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
</form>
