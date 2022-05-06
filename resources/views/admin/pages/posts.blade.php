@extends('layouts.admin')

@section('content')

<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 mt-4 text-gray-800">Posts</h1>

  @include('admin.posts.index')

</div>

@endsection