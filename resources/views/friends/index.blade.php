@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-md-10">
                <div class="panel-body">
                    @if ($user->friends()->count() === 0)
                        <h4 class="text-center">Brak znajomych</h4>
                    @else
                        <h4 class="text-center">Lista znajomych <span class="label label-primary">{{$user->friends()->count()}}</span>  </h4>
                        <div class="row">
                            @foreach ($user->friends() as $user)
                                <div class="col-sm-4 text-content">
                                    <a href="{{ url('/users/' . $user->id) }}">
                                        <div class="">

                                            <img src="{{ url('/img/user-avatar/' . $user->id . '/250') }}"
                                                 alt="{{$user->name}}" class="img-responsive">
                                            <h5>{{ $user->name }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
