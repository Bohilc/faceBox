@extends('layouts.app')

@section('content')
    <div class="container col-md-8" style="margin: auto;">
        <div id="comment_id_{{ $comment->id }}" class="row">
            @if (Auth::check())
                <form method="POST" action="{{url('/comments/' . $comment->id )}}">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div>
                        <textarea
                                class="form-control  {{$errors->has('comment_content') ? 'is-invalid': ''}}"
                                name="comment_content"
                                id=""
                                cols="60"
                                rows="5">
                            {{ $comment->content }}
                        </textarea>

                        @if( $errors->has('post_content') )
                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('comment_content') }}</strong>
                                </span>
                        @endif
                        <button type="submit" class="btn btn-default float-right">Zapisz zmiany</button>
                    </div>

                </form>
            @endif
        </div>
    </div>

@endsection