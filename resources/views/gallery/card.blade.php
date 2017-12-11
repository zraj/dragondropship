  @foreach($gallery as $gal)
                                                <div class="col-3">
                                                    <div class="card">
                                                        <div class="card-block">
                                                          <a href="{{ asset('uploads/product/gallery/'.$gal->photo_name) }}" data-lightbox="product-image">
                                                             <img src="{{ asset('uploads/product/gallery/'.$gal->photo_name) }}" alt="" width="100px;">
                                                        </a>
                                                        </div>
                                                        <div class="card-footer">
                                                               @component('layouts.btndel',['method'=>'POST',
                                                                'action'=>'/photo/'.$gal->id,
                                                                'inputname'=>'id',
                                                                'id'=> $gal->id,
                                                                'deltext'=> '',
                                                                'delete_tag'=> true ]) 
                                                                @endcomponent
                                                        </div>
                                                    </div>
                                                </div>
                                                   
                                                                                                        
@endforeach