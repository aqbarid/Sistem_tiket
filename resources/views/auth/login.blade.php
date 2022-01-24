@extends('layouts.auth')

@section('content')
<div class="login-form">
  <form action="/login" method="post">
    <h2>Login</h2>
    @error
    @success
    <input type="email" placeholder="Enter Email" name="email" >
    <input type="password" placeholder="Enter password" name="password" >
    <button type="submit">Login</button>
    <div class="w-100 d-flex justify-content-center">
      <a href="/register">Register</a>
    </div>
  </form>
</div>
@endsection