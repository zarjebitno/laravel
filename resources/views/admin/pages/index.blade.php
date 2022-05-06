@extends('layouts.admin')

@section('content')

<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 mt-4 text-gray-800">Welcome to the Admin Panel</h1>

</div>

<div class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="card col-lg-4 py-4 text-center">
        <h2>New Posts Today</h2>
        <h3>{{ $latestPosts }}</h3>
      </div>
      <div class="card col-lg-4 py-4 text-center">
        <h2>New Comments Today</h2>
        <h3>{{ $latestComments }}</h3>
      </div>
      <div class="card col-lg-4 py-4  text-center">
        <h2>Total Posts</h2>
        <h3>{{ $allPostsNum }}</h3>
      </div>
    </div>
    <div class="row d-flex flex-column">
      <form class="form-inline">
        <label for="created_at" class="mr-2">Select date</label>
        <input type="date" class="form-control mr- 4" id="created_at_log" name="created_at">
      </form>
      <table class="table table-striped table-dark col-lg-10 mx-auto mt-4">
        <thead>
          <tr>
            <th scope="col">Logs</th>
          </tr>
        </thead>
        <tbody id="log-wrap">
          @foreach($logFile as $line)
            <tr>
              <td>{{ $line }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <ul class="d-flex" id="log-pag">
        @for($i = 1; $i <= $totalPages; $i++)
          <li class="list-group-item"><a href="#" class="log-pagination-item" data-page="{{ $i }}">{{ $i }}</a></li>
        @endfor
      </ul>
    </div>
  </div>
</div>

@endsection