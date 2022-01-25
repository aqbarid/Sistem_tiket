@extends('layouts.seller')


<style>
  .card-image {
    height: 200px;
    width: 100%;
  }
  .card-image img {
    object-fit: cover;
    height: 100%;
    width: 100%;
  }
</style>


@section('content')
  <div class="w-100">
    <h2 class="text-dark fw-bold">Add New Room</h2>
  </div>
  @error
  @success
  <div class="w-100 mt-3">
    <div class="card p-3">
      <div class="row">
        <div class="col-md-6">
         <form action="/seller/room" method="POST">
            @include('components.input', ['name' => 'name', 'label' => 'Place Name'])
            @include('components.input', ['name' => 'type', 'label' => 'Room Type'])
            @include('components.input', ['name' => 'price_monthly', 'label' => 'Price Monthly'])
            @include('components.input', ['name' => 'price_daily', 'label' => 'Price Daily'])
            @include('components.input', ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'])
            <div class="w-100 d-flex mt-3">
              <button class="btn btn-primary ms-auto">Submit</button>
            </div>
         </form>
        </div>
      </div>
    </div>
  </div>

@endSection