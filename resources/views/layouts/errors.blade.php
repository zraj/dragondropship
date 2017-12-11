@isset($errors)
  @if($errors->any())
    <div id="flash-message" class="alert alert-success alert-dismissible fade show col-6" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
         <strong>
            @foreach($errors->all() as $error)

             <li>{{ $error }}</li>

            @endforeach
        </strong>

    </div>
  @endif  
@endisset
