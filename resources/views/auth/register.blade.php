@extends('layouts.auth')

@section('content')
<div class="login-form">
  <form action="/register" method="post">
    <h2>Register</h2>
    @error
    @success
    <label for="" class="col-form-label">Name</label>
    <input type="text" placeholder="name" name="name" >
    <label for="" class="col-form-label">Email</label>
    <input type="text" placeholder="email" name="email" >
    <label for="" class="col-form-label">Phone</label>
    <input type="text" placeholder="phone" name="phone" >
    <label for="" class="col-form-label">Address</label>
    <textarea name="address" id="" cols="30" rows="40"></textarea>
    <input type="password" placeholder="Enter password" name="password" >
    <label for="" class="col-form-label">Role</label>
    <select name="role" id="" class="form-control">
      <option value="customer">Customer</option>
      <option value="seller">Place Owner</option>
    </select>
    <button type="submit">Register</button>
    <div class="w-100 d-flex justify-content-center">
      <a href="/login">Login</a>
    </div>
  </form>
</div>
@endsection