<div class="dropdown float-right">
    <a href="" class="dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li><a href="{{ url('/comments/' . $comment->id . '/edit') }}">Edytuj</a></li>
        <li>
            <form id="form_comment_delete_{{ $comment->id }}" method="POST" action="{{ url('/comments/' . $comment->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p onClick="return confirmDeleteComment({{ $comment->id }})">Usuń</p>
            </form>
        </li>
    </ul>
</div>