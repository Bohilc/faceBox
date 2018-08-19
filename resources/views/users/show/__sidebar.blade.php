<div class="col-md-4 col-md-offset-1">
    <div class="card card-header">
        @if($user->id === Auth::id())
            <a href="{{url('/users/' . $user->id . '/edit')}}" class="pull-right">Edytuj</a>
        @endif
    </div>

    <div class="card">
        <div class="card-body text-center">
            <img class=" " src="{{ url('/img/user-avatar/' . $user->id . '/250') }}" alt="">
        <!-- <h1><a href="{{url('/users/'.$user->id)}}">{{$user->name}}</a></h1> -->
            <h2>{{ $user->name }} {{ $user->lastName }}</h2>
            @if ($user->sex == 'm')
                <p>Męzczyzna</p>
            @else
                Kobieta
            @endif
            <p>{{$user->email}}</p>
            <p><a href="{{url('/users/' . $user->id . '/friends')}}">Znajomi</a>: <span class="badge badge-info">{{$user->friends()->count()}}</span></p>

            @if(isUserLogin())
                @if(!friendship($user->id)->exists && !has_friend_invitation($user->id))
                    <form method="POST" action="{{ url('/friends/' . $user->id) }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Zaproś do znajomych</button>
                    </form>

                @elseif (has_friend_invitation($user->id))
                    <form method="POST" action="{{ url('/friends/' . $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <button type="submit" class="btn btn-primary">Przyjmij zaproszenie</button>
                    </form>

                @elseif (friendship($user->id)->exists && !friendship($user->id)->accepted)
                    <button type="submit" class="btn btn-success disabled">Zaproszenie wysłane</button>

                @elseif (friendship($user->id)->exists && friendship($user->id)->accepted)
                    <form  action="{{ url('/friends/' . $user->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Uzuń ze znajomych</button>
                    </form>
                @endif
            @endif

        </div>

    </div>
</div>