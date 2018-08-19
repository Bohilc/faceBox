@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('users.show.__sidebar')

            <div class=" col-md-7">
                @if (Auth::check() && Auth::id() === $user->id)
                    <div class="panel panel-default">
                        @include('posts.create')
                    </div>
                @endif

                @foreach($posts as $post)
                    @include('posts.include.single')
                @endforeach

            </div>

        </div>
    </div>

@endsection