@if (count($amphures) > 0)
  <select class="form-control" name="input-amphur">
    @foreach ($amphures as $amp)
      <option value="{{$amp->AMPHUR_NAME}}">{{$amp->AMPHUR_NAME}}</option>
    @endforeach
  </select>
@endif
