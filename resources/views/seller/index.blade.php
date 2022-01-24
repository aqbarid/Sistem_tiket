@extends('layouts.seller')

@section('content')
  <div class="w-100">
    <h2 class="text-dark fw-bold">Welcome {{ $user->name }} ON Place {{ isset($place->name) ? $place->name : '-' }}</h2>
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