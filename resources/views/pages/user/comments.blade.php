@extends('layouts.app')

@section('content')
  <div class="container">
    @if($comments)
    <table class="table table-hover table-sm">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Comment</th>
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($comments as $key => $comment)
        <tr>
          <th scope="row">{{ $key + 1 }}</th>
          <td>{{ $comment->content }}</td>
          <td>{{ date('jS F, Y', strtotime($comment->created_at)) }}</td>
          <td class="d-flex justify-content-between">
            <a href="{{ route('posts.show', ['post' => $comment->post_id]) }}" class="fas fa-eye"></a>
            <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <input type="hidden" name="comment_id" value="{{ $comment->id }}">
              <button type="submit">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
      <p>No comments.</p>
    @endif
  </div>
@endsection