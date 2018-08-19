<form method="POST" action="{{url('/comments')}}">
    {{csrf_field()}}
    {{method_field('POST')}}


    <div class="float-left">
        <img src="{{ url('/img/user-avatar/' . Auth::id() . '/35') }}" alt="" class="rounded">
    </div>

    <div class="form-group float-right" style="width: 90%;">
        <input
                class="form-control  {{$errors->has('comments_content_' . $post->id ) ? 'is-invalid': ''}}"
                name="comments_content_{{ $post->id }}"
                id="comment_for_post_{{ $post->id }}"
                placeholder="Napisz komentarz"
                value="{{ old('comments_content_' . $post->id ) }}">
        <input type="hidden" name="post_id" value="{{ $post->id }}">

        @if( $errors->has('comments_content_' . $post->id ) )
            <span class="invalid-feedback">
                <strong>{{ $errors->first('comments_content_' . $post->id) }}</strong>
            </span>
        @endif

        <button type="submit" style="margin: 10px;" class="btn btn-default float-right">Dodaj komentaż</button>
    </div>

</form>