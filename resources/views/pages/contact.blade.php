@extends('layouts.app')

@section('meta')
  <meta name="description" content="Contact website admin">
  <meta name="keywords" content="mark, contact, email, send, support">
  <title>CONTACT</title>
@endsection

@section('content')

  <div class="container">
    <form action="{{ @route('contact.sendMail') }}" method="post" class='py-5'>
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" id="name" type="text" name="name" @if(Auth::id()) value="{{ Auth::user()->first_name }}" @endif>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" id="email" type="email" name="email" @if(Auth::id()) value="{{ Auth::user()->email }}" @endif>
      </div>
      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message"></textarea>
      </div>
      <input class="btn btn-primary" type="submit" value="Submit" />
      </div>
    </form>
  </div>

@endsection