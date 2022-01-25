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
    <h2 class="text-dark fw-bold">Rooms On place {{ isset($place->name) ? $place->name : '-' }}</h2>
  </div>
  <div class="w-100 mt-3">
    <div class="w-100 mb-3 d-flex border-bottom align-items-center pb-3">
      <h5>10 Rooms</h5>
      <a href="/seller/room/create" class="btn btn-primary ms-auto">Add New</a>
    </div>
    @error
    @success
    <div class="row">
      <div class="col-md-4">
        <a href="" class="text-decoration-none">
          <div class="card rounded-0">
            <div class="card-image">
              <img src="https://media.istockphoto.com/photos/large-cargo-airplane-taking-off-picture-id1201849974" alt="">
            </div>
            <div class="card-content">
              <div class="container-fluid py-3">
                <h4 class="text-dark fw-bold">oiuytrerty</h4>
                <h5 class="text-warning">500k</h5>
                <span class="badge bg-success">Available</span>
                <p class="text-body">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

@endSection