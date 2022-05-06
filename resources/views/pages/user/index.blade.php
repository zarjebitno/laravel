@extends('layouts.app')

@section('content')
<section class="section lb">
  @if(session('loginError'))
      <div class="container">
          <div class="alert alert-danger">
              {{ session('loginError') }}
          </div>
      </div>
  @endif
  @if(session('success'))
      <div class="container">
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      </div>
  @endif
  <div class="container">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="page-wrapper">
                  <div class="blog-custom-build">
                    <a href="{{ @route('posts.create') }}" class="d-block btn btn-danger mb-4">
                      <i class="fas fa-pen"></i>
                      Write a Post
                    </a>
                    <a href="{{ @route('posts.user', ['user' => Auth::id()]) }}" class="d-block btn btn-primary mb-4">
                      <i class="fas fa-book-open"></i>
                      My Posts
                    </a>
                    <a href="{{ @route('comments.index', ['user' => Auth::id()]) }}" class="d-block btn btn-success mb-4">
                      <i class="fas fa-comments"></i>
                      My Comments
                    </a>
                    <a href="{{ @route('users.edit', ['user' => Auth::id()]) }}" class="d-block btn btn-light mb-4">
                      <i class="fas fa-user-edit"></i>
                      Edit Information
                    </a>
                  </div>
              </div>

              <hr class="invis">
          </div><!-- end col -->
      </div><!-- end row -->
  </div><!-- end container -->
</section>
@endsection