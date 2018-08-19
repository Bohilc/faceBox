<div class="dropdown float-right">
    <a href="" class="dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li><a href="{{ url('/posts/' . $post->id . '/edit') }}">Edytuj</a></li>
        <li>
            <form id="form_post_delete_{{ $post->id }}" method="POST" action="{{ url('/posts/' . $post->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p onClick="return confirmDeletePost({{ $post->id }})">Usuń</p>
            </form>
        </li>
    </ul>
</div>