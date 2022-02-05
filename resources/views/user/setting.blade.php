@extends('layouts.user')

@section('content')
  <div class="w-100">
    <h2 class="text-dark fw-bold">Account Setting</h2>
  </div>
  <div class="card p-3">
    <div class="row">
      <div class="col-md-6"> 
        @error
        @success
        <form action="/user/setting" method="POST">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_action" value="detail">
          <div class="form-group"></div>
          @include('components.input', ['name' => 'email', 'label' => 'Email', 'value' => $user->email])
          @include('components.input', ['name' => 'name', 'label' => 'Name', 'value' => $user->name])
          @include('components.input', ['name' => 'phone', 'label' => 'Phone', 'value' => $user->phone])
          @include('components.input', ['name' => 'address', 'type' => 'textarea', 'label' => 'Address', 'value' => $user->address])
          <div class="w-100 mt-4 d-flex">
            <button class="ms-auto btn btn-primary">Update</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>

  <div class="w-100 mt-4">
    <h2 class="text-dark fw-bold">Change Password</h2>
  </div>


  <div class="card p-3 mt-3">
    <div class="row">
      <div class="col-md-6"> 
        @error
        @success
        <form action="/user/setting" method="POST">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_action" value="password">
          <div class="form-group"></div>
          @include('components.input', ['name' => 'old_password', 'type' => 'password', 'label' => 'Old Password'])
          @include('components.input', ['name' => 'new_password', 'type' => 'password', 'label' => 'New Password'])
          @include('components.input', ['name' => 'confirm_password', 'type' => 'password', 'label' => 'Confirm Password'])
          <div class="w-100 mt-4 d-flex">
            <button class="ms-auto btn btn-primary">Change Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>


@endSection