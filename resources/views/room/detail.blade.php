@extends('layouts/app')

<style>
  .banner-image {
    height: 650px;
    object-fit: cover;
  }
</style>


@section('content')     
  
  <section class="banner mt-5">
    <div class="container">
      @error
      <img src="{{ $room->image }}" class="banner-image w-100" alt="">
    </div>
  </section>
  <section class="list mt-5 pb-5">
    <div class="container">
      <h2 class="fw-bold">Kosan {{ $room->name }}</h2>
      <h4>
        <span class="badge bg-warning">IDR {{ $room->price_monthly }} / Bulan </span> Atau  <span class="badge bg-primary">IDR {{ $room->price_daily }} / Hari </span> 
      </h4>
      <h4 class="mt-3">Dari <a href="/place/{{ $place->id }}" class="btn-link text-decoration-none">{{ $place->name }}</a> kos</h4>
      
     <div class="w-100">
      <div class="me-auto" style="max-width: 400px;">
        <table class="table">
          <tr>
            <td>Tipe</td>
            <td>:</td>
            <td>{{ $room->type }}</td>
          </tr>
          <tr>
            <td>Masih Tersedia </td>
            <td>:</td>
            <td>{{ $room->is_available ? 'Masih' : 'Penuh' }}</td>
          </tr>
        </table>
      </div>
      <div class="w-100 py-4">
        <form action="/checkout" method="POST">
          <input type="hidden" name="room_id" value="{{ $room->id }}">
          <button class="btn btn-primary">Ambil Kamar Ini</button>
        </form>
      </div>
      <div class="w-100">
        <h5>Deskripsi: </h5>
        <div class="row">
          <div class="col-md-8">
            <p>{{ $room->description }}</p>
          </div>
        </div>
      </div>
     </div>

      {{-- <div class="row mt-4">
        @foreach ($rooms as $key => $room )
          <div class="col-md-4">
            <a href="/rooms/{{ $room->id }}" class="text-decoration-none  ation-none">
              <div class="card rounded-0">
                <div class="card-image">
                  <img src="{{ $room->image }}" alt="">
                </div>
                <div class="card-content">
                  <div class="container-fluid py-3">
                    <h4 class="text-dark fw-bold">{{ $room->name }}</h4>
                    <h5 class="text-warning">IDR {{ $room->price_monthly }}</h5>
                    <p class="text-body">{{ limitText($room->description) }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach --}}
      </div>
    </div>
  </section>
@endsection