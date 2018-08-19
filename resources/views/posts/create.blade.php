<form method="POST" action="{{url('/posts')}}">
    {{csrf_field()}}
    {{method_field('POST')}}


    <div class="form-group">
        <textarea
                class="form-control  {{$errors->has('post_content') ? 'is-invalid': ''}}"
                name="post_content"
                id=""
                cols="60"
                placeholder="jak tam"
                rows="5">{{ old('post_content') }}
        </textarea>

        @if( $errors->has('post_content') )
            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('post_content') }}</strong>
                                </span>
        @endif
        <button type="submit" class="btn btn-default">Dodaj post</button>
    </div>

</form>