@extends('layouts.app')

@section('meta')
  <meta name="description" content="Read blogs today">
  <meta name="keywords" content="mark, blog, laravel">
  <title>HOME</title>
@endsection

@section('content')
  <section class="section lb">
    @if (session('loginError'))
        <div class="container">
            <div class="alert alert-danger">
                {{ session('loginError') }}
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-custom-build">
                        @if(\Request::route()->getName() === 'home')
                        <form class="container px-0 pb-4" method="GET" action="{{ @route('posts.fetch') }}">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="post_name" id="search_product_input"/>
                                <span class="input-group-text border-0 ml-4" id="search-addon" data-sort="0">
                                    <i class="fas fa-sort"></i>
                                    <small class='ml-2'>sort by date</small>
                                </span>
                              </div>
                        </form>
                        @endif
                        <div class="blog-custom-single-wrap">
                            {{-- component single blog --}}
                            @forelse($posts as $post)
                              @component('components.single-post', ['post' => $post]) @endcomponent
                              @empty
                                <p>No available posts.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <hr class="invis">

                <div class="row" id="main-nav">
                    <div class="col-md-12">
                        {{ $posts->links() }}
                    </div><!-- end col -->
                </div><!-- end row -->
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