@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (Auth::check())
                <form method="POST" action="{{url('/posts/' . $post->id )}}">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="">
                        <textarea
                                class="form-control  {{$errors->has('post_content') ? 'is-invalid': ''}}"
                                name="post_content"
                                id=""
                                cols="60"
                                rows="5">
                            {{ $post->content }}
                        </textarea>

                        @if( $errors->has('post_content') )
                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('post_content') }}</strong>
                                </span>
                        @endif
                        <button type="submit" class="btn btn-default float-right">Zapisz zmiany</button>
                    </div>

                </form>
            @endif
        </div>
    </div>

@endsection