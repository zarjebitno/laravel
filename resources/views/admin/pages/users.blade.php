@extends('layouts.admin')

@section('content')

<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 mt-4 text-gray-800">Users</h1>

  @include('admin.users.index')

</div>

@endsection