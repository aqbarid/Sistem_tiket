@extends('layouts/app')

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
  <section class="banner">
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://media.istockphoto.com/photos/large-cargo-airplane-taking-off-picture-id1201849974" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://media.istockphoto.com/photos/large-cargo-airplane-taking-off-picture-id1201849974" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://media.istockphoto.com/photos/large-cargo-airplane-taking-off-picture-id1201849974" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>
  <section class="list mt-5 pb-5">
    <div class="container">
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
                  <p class="text-body">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus expedita molestias vero atque in. Aut dolores consectetur architecto enim quis a qui. Molestias provident fugit illo ipsa in, tenetur repellat?</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection