@extends('layouts.app')

@section('meta')
  <meta name="description" content="About author">
  <meta name="keywords" content="author, mateja, laravel, vue">
  <title>ABOUT</title>
@endsection

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1>Mateja Jukic 147/17</h1>
      </div>
      <div class="card-body">
        <img src="{{ @asset('assets/images/about.jpg') }}" alt="About" class="img-fluid"/>
      </div>
    </div>
  </div>
@endsection