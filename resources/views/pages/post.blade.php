@extends('layouts.app')

@section('content')
  <section class="section lb">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <input type="hidden" value="{{ $post->id }}" id="post-id">
                <div class="page-wrapper">
                    <div class="blog-custom-build">
                      @include('partials.post')
                      @include('partials.comment-form')
                      @include('partials.comments')
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">

                    <div class="widget">
                        <h2 class="widget-title">Popular Categories</h2>
                        <div class="link-widget">
                            <ul>
                                @foreach($categories as $cat)
                                    <li><a href="{{ @route('posts.category', ['category' => $cat->id]) }}">{{ $cat->name }} <span>({{ count($cat->posts) }})</span></a></li>
                                @endforeach
                            </ul>
                        </div><!-- end link-widget -->
                    </div><!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
  </section>
@endsection