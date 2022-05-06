@auth
  <form action="{{ @route('comments.store', ['post' => $post->id]) }}" method="POST" class="pb-4" id="comment-form">
    @csrf
    <textarea name="content" class='form-control' rows="5" placeholder="Write a comment"></textarea>
    <button type="button" class="btn btn-primary mt-3 comment-submit-btn">Submit</button>
  </form>
@endauth
@guest
  <p>Log in to post a comment.</p>   
@endguest