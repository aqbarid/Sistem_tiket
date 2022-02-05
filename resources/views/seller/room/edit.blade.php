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
    <h2 class="text-dark fw-bold">Edit Room</h2>
  </div>
  @error
  @success
  <div class="w-100 mt-3">
    <div class="card p-3">
      <div class="row">
        <div class="col-md-6">
          <img src="/uploads/{{ $room->image }}" class="w-100 h-100" style="object-fit: cover" alt="">
        </div>
        <div class="col-md-6">
         <form action="/seller/room/{{ $room->id }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @include('components.input', ['name' => 'name', 'label' => 'Place Name', 'value' => $room->name])
            @include('components.input', ['name' => 'type', 'label' => 'Room Type', 'value' => $room->type])
            @include('components.input', ['name' => 'image', 'label' => 'Room Image', 'type' => 'file'])
            @include('components.input', ['name' => 'price_monthly', 'label' => 'Price Monthly', 'value' => $room->price_monthly])
            @include('components.input', ['name' => 'price_daily', 'label' => 'Price Daily', 'value' => $room->price_daily])
            @include('components.input', ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'value' => $room->description])
            <div class="w-100 d-flex mt-3">
              <button class="btn btn-primary ms-auto">Update</button>
            </div>
         </form>
        </div>
      </div>
    </div>
  </div>

@endSection