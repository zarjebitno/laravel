<div class="container mb-3 p-0">
  <div class="card mt-4 border-0">
    <div class="card-header">
      <h3 class="card-title">{{$post->title}}</h3>
      <p>Author: {{ $post->user->username }} </p>
    </div>
      @if($post->image)
        <img class="card-img-top img-fluid" src="{{ @asset('assets/images/posts/'.$post->image) }}" alt="{{ $post->image }}">
      @endif
      <div class="card-body">
          <p>{{$post->content}}</p>
      </div>
  </div>
</div>