<div id="post_{{ $post->id }}" class="card" style="margin-bottom: 15px;">
    <div class="card-body">
        <div class="clearfix">

            @if(Auth::check() && $post->user_id === Auth::id())
                @include('posts.include.dropdown_menu')
            @endif

            <div style="display: inline-block;">
                <img class="rounded" src="{{ url('/img/user-avatar/' . $post->user->id . '/50') }}" alt="">
                <a href="{{ url('/users/' . $post->user->id) }}"><strong>{{$post->user['name']}}</strong></a>
                <br>
                <a href="{{ url('/posts/' . $post->id) }}">{{$post->created_at}}</a>
            </div>

            <p>{{ $post->content }}</p>
                @if(Auth::check())
                    @include('comments.include.create')
                @endif
        </div>



        @foreach($post->comments as $comment)
            @if( ! $loop->first)
                <hr style="margin: 10px 0;">
            @endif

            @if(Auth::check() && $comment->user_id === Auth::id())
                @include('comments.include.dropdown_menu')
            @endif

            <div style="display: inline-block;">
                <img class="rounded" src="{{ url('/img/user-avatar/' . $comment->user->id . '/30') }}" alt="">
                <a href="{{ url('/users/' . $comment->user_id) }}">
                    <strong>{{ $comment->user->name }}</strong>
                </a>
                <p style="margin-left: 35px;">{{ $comment->content }}</p>
            </div>
        @endforeach
    </div>
</div>
