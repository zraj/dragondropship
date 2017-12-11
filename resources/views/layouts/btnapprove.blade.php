<form class="doapprove" method="{{ $method }}" action="{{ $action }}">
{{ csrf_field()}}
@if($delete_tag == true)
   {{ method_field('DELETE') }}
@endif

<input type="hidden" name="{{$inputname}}" value="{{ $id }}">
<button type="submit" class="btn {{ $class or 'btn-success-outline btn-sm'}}"> <i class="fa fa-check" aria-hidden="true"></i> {{$btntext}}</button>
 {{ $slot}}
</form>
