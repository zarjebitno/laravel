@extends('layouts.admin')

@section('content')

<div class="row">

  <div class="col-lg-10 mx-auto mt-5">

      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Manage comments</h6>
          </div>
          <div class="card-body">
            <table class="table table-hover table-sm">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Comment</th>
                  <th scope="col">Post</th>
                  <th scope="col">Posted At</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="post-wrap">
                @foreach($comments as $key => $comment)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $comment->content }}</td>
                  <td>{{ $comment->post->title }}</td>
                  <td>{{ date('F j, Y', $comment->postedAt) }}</td>
                  <td class="d-flex justify-content-between">
                    <a href="{{ route('posts.show', ['post' => $comment->post_id]) }}" class="fas fa-eye"></a>
                    <form action="{{ route('admin.comments.destroy', ['comment' => $comment->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="delete-comment-btn" data-comment-id='{{ $comment->id }}'>
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $comments->links() }}
          </div>
      </div>

  </div>

</div>

@endsection