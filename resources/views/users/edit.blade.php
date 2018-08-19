@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="card card-header">Edycja</div>
            <div class="card card-body">

            @if ($user->avatar)
                <img class="img-responsive" src="{{ url('/img/user-avatar/' . $user->id . '/600') }}" alt="avatar">
            @else
                <img class="img-responsive" src="{{ url('/img/user-avatar/' . $user->id . '/600') }}" alt="avatar">
            @endif
                {{ asset('users/' . $user->id . '/avatars/' . $user->avatar) }}
            <form action="{{url('/users/' . $user->id)}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <div class="form-group">
                            <label class="form-control-label" for="avatar">Avatar:</label>
                            <input id="avatar" class="" name="avatar" type="file" placecholder="Wybier plik">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <div class="form-group">
                            <label class="form-control-label" for="Name">Imię:</label>
                            <input id="name" class="form-control {{ $errors->first('name')? ' is-invalid' : '' }} " name="name" type="text" value="{{$user->name}}">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- last name -->
                <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <div class="form-group">
                            <label for="lastName">Nazwisko:</label>
                            <input id="lastName" class="form-control {{ $errors->first('lastName') ? ' is-invalid' : '' }}" name="lastName" type="text" value="{{$user->lastName}}">

                            @if ($errors->has('lastName'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('lastName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- sex -->
                <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <div class="form-group">
                        <label for="sex">Płeć:</label>
                            <select id="sex" type="text" name="sex" class="form-control" id="sex">
                                <option value="m" @if($user->sex == 'm') selected @endif>Męzczyzna</option>
                                <option value="f" @if($user->sex == 'f') selected @endif>Kobieta</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- email -->
                <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input id="email" class="form-control {{ $errors->first('email') ? ' is-invalid' : '' }}" name="email" type="email" value="{{$user->email}}">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 offset-sm-1 pull-right text-right">
                        <button type="submit" class="btn btn-primary pull-right">Zapisz</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection