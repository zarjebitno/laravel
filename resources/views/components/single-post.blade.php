<div class="blog-box">
  <div class="post-media">
      <a href="{{ @route('posts.show', ['post' => $post->id]) }}" title="">
          <img src="{{ @asset('assets/images/posts/'. $post->image) }}" alt="{{ $post->image }}" class="img-fluid">
      </a>
  </div>
  <!-- end media -->
  <div class="blog-meta big-meta text-center">
      <h4><a href="{{ @route('posts.show', ['post' => $post->id]) }}" title="">{{ $post->title }}</a></h4>
      <p>{{ Str::words($post->content, 30) }}</p>
      <small><a href="{{ @route('posts.category', ['category' => $post->cat_id]) }}" title="">{{ $post->category->name }}</a></small>
      <small>{{ date('F j, Y', $post->postedAt) }}</small>
      <small>
          <span>by </span>
          <a href="{{ @route('posts.user', ['user' => $post->user_id]) }}" title="">{{ $post->user->username }}</a>
        </small>
      <small><i class="fa fa-comment"></i> {{ count($post->comments) ? count($post->comments) : "No Comments" }}</small>
  </div><!-- end meta -->
</div><!-- end blog-box -->




