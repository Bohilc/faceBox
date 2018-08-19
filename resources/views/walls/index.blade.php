@extends('layouts.app')

@section('content')
    <div class="col-md-8" style="margin: auto;">
        <div class="row">


            <div class=" col-md-12">
                @if (Auth::check())
                    <div class="panel panel-default">
                        @include('posts.create')
                    </div>
                @endif

                @foreach($posts as $post)
                    @include('posts.include.single')
                @endforeach

                {{ $posts }}

            </div>

        </div>
    </div>

@endsection