<div class="comments-wrap">
  @foreach($post->comments as $comment)
    <div class="container mb-3 p0 single-comment">
      <div class="card-header d-flex justify-content-between align-items-center">
        <p class='m-0'>{{ $post->user->username }}</p>
        <small class='d-block'>{{ date('jS F, Y', strtotime($comment->created_at)) }}</small>
      </div>
      <div class="card-body position-relative">
        <p>{{ $comment->content }}</p>
        @if(Auth::id() == $comment->user_id)
          <form action="{{ @route('comments.destroy', ['comment' => $comment->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
            <input type="hidden" name="user_id" value="{{ $comment->user_id }}" id="user-id"/>
            <i class="fas fa-trash position-absolute top-50% right-0 delete-comment-user" data-commentID='{{ $comment->id }}'></i>
          </form>
        @endif
      </div>
    </div>
  @endforeach
</div>