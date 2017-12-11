@isset($category->attributes)
  @foreach($category->attributes as $att)
  <div class="form-group row">
      <label for="base-image" class="col-2 col-form-label">{{$att->attribute->name}}</label>
      <div class="col-10">
          <select name="att_value_id[]" id="att_value_id">
      @foreach($att->attribute->values as $value)
          <option value="{{$value->att_value_id}}">{{ $value->value_name}}</option>
      @endforeach
  </select>
      </div>


  </div>

  @endforeach
@endisset
