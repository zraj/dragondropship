@foreach ($districts as $district)

   {{$district->DISTRICT_NAME}}

@endforeach

<select class="form-control" name="input-amphur">
  @foreach ($amphures as $amp)
    <option value="{{$amp->AMPHUR_NAME}}">{{$amp->AMPHUR_NAME}}</option>
  @endforeach
</select>

<select class="form-control" name="input-province">
  @foreach ($provinces as $province)
    <option value="{{$province->PROVINCE_NAME}}">{{$province->PROVINCE_NAME}}</option> 
  @endforeach
</select>
