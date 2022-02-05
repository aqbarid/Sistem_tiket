@extends('layouts.seller')

@section('content')
  <div class="w-100">
    <div class="card p-3 bg-primary">
      <h2 class="text-dark fw-bold text-white mt-3 mb-3">Hi {{ $user->name }}</h2>
      <h5 class="text-white fw-normal">Welcome back to your space <span class="fw-bold">{{ isset($place->name) ? $place->name : '-' }}</span></h5>
    </div>
  </div>
  
  <div class="w-100 mt-3">
    <div class="row">
      <div class="col-md-4">
        <div class="card bg-primary text-white">
          <div class="p-3">
            <h3>10</h3>
            <p>Total Rooms</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-primary text-white">
          <div class="p-3">
            <h3>10 IDR</h3>
            <p>Total Income</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-primary text-white">
          <div class="p-3">
            <h3>1000 IDR</h3>
            <p>Balance </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-100">
    <div class="w-100">
      
    </div>
  </div>
@endSection