@extends('layouts.app')

@section('meta')
  <meta name="description" content="Read blogs today">
  <meta name="keywords" content="mark, blog, laravel">
  <title>REGISTER</title>
@endsection

@section('content')
<form class="form-horizontal pb-5" action='{{ @route('register.store') }}' method="POST" id="register-form">
  @csrf
  <fieldset class="m-auto col-lg-4">
    <div id="legend">
      <legend class="">Register</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge w-100 form-control" value="{{ old('username') }}">
      </div>
      @error('username')
        <div class="alert alert-danger" role="alert">
          Username required.
        </div>
      @enderror
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge w-100 form-control" value="{{ old('email') }}">
      </div>
      @error('email')
        <div class="alert alert-danger" role="alert">
          Email required.
        </div>
      @enderror
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <small>minimum 8 characters</small>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge w-100 form-control">
      </div>
      <div class="pass-err">Password not right</div>
    </div>
 
    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="" class="input-xlarge w-100 form-control">
      </div>
    </div>

    @error('username')
        <div class="alert alert-danger" role="alert">
          Passwords do not match.
        </div>
      @enderror
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" type="button">Register</button>
      </div>
    </div>
  </fieldset>
</form>

@endsection