<form class="dosubmit" method="{{ $method }}" action="{{ $action }}">
{{ csrf_field()}}
@if($delete_tag == true)
   {{ method_field('DELETE') }}
@endif

<input type="hidden" name="{{$inputname}}" value="{{ $id }}">
<button type="submit" class="btn {{ $class or 'btn-danger-outline btn-sm'}}"> <i class="fa fa-trash" aria-hidden="true"></i> {{$deltext}}</button>
 {{ $slot}}
</form>