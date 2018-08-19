@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-10">
                Wyniki wyszukiwania:
            </div>
            <div class=" card col-md-10">
                <div class="panel-body">
                    @if ($search_users_from_DB->count() === 0)
                        <h4 class="text-center">Brak wyników</h4>
                    @else
                        <div class="row">
                            @foreach ($search_users_from_DB as $user)
                                <div class="col-sm-4 text-content">
                                    <a href="{{ url('/users/' . $user->id) }}">
                                        <div class="thumbnail img-thumbnail text-center">
                                            <img src="{{ url('/img/user-avatar/' . $user->id . '/250') }}"
                                                 alt="{{$user->name}}" class="img-responsive">
                                            <h5>{{ $user->name }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            {{ $search_users_from_DB }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection