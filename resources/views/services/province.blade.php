@if (count($provinces) > 0)
  <select class="form-control" name="input-province">
    @foreach ($provinces as $province)
      <option value="{{$province->PROVINCE_NAME}}">{{$province->PROVINCE_NAME}}</option>
    @endforeach
  </select>
@endif
