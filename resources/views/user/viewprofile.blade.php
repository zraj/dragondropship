@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">

            <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card">
                    <img class="card-img-top" src="img/avatars/{{ $user->avatar }}">
                    <div class="card-block">
                        <h4 class="card-title">{{ $user->name }}</h4>
                        <div class="card-text">
                            Type : {{ $user->usertypes->type_name }}
                        </div>
                        <div class="card-text">
                            Level : {{$user->level}}
                        </div>
                          <div class="card-text">
                            {{-- Cash : $ {{number_format($user->cash,2)}} Baht --}}
                              Cash : $ {{number_format($user->cash)}} Baht
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="float-right">Registered on {{ $user->created_at->diffForHumans() }}</span>
                        <span><i class=""></i><a href="#">3 Reseller</a></span>
                    </div>
                </div>
            </div>


        </div>

</div>

@endsection

@section('user_script')


@endsection
