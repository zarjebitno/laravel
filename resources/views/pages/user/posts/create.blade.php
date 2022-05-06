@extends('layouts.app')

@section('content')
<div class="container py-4">
  <form method="POST" action="{{ @route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleFormControlInput1">Post Title</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="post_title">
    </div>
    <div class="form-group">
      <div class="form-group">
        <label for="exampleFormControlFile1">Featured Image</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="post_image">
      </div>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Post Category</label>
      <select class="form-control" id="exampleFormControlSelect2" name="post_cat">
        <option value="0">Select a category</option>
        @foreach ($categories as $cat)
          <option value="{{ $cat->id }}">{{ $cat->name }}</option>  
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Post Content</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_content"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection