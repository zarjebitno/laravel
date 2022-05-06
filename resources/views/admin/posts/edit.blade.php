@extends('layouts.admin')

@section('content')
<div class="row">

  <div class="col-lg-10">

      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit post</h6>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ @route('admin.posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="exampleFormControlInput1">Post Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="post_title" value='{{ $post->title }}'>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="exampleFormControlFile1">Featured Image</label>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1" name="post_image">
                </div>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect2">Post Category</label>
                <select class="form-control" id="exampleFormControlSelect2" name="post_cat" value="{{ $post->cat_id }}">
                  <option value="0">Select a category</option>
                  @foreach ($categories as $cat)
                    <option @if($cat->id === $post->cat_id) selected @endif value="{{ $cat->id }}">{{ $cat->name }}</option>  
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Post Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_content">
                  {{ $post->content }}
                </textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
      </div>

  </div>

</div>
@endsection