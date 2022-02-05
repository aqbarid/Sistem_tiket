@extends('layouts.admin')

@section('content')
  <div class="w-100 mt-5">
    <h3>Rooms <span class="text-primary">{{ $totalRoom }}</span></h3>
  </div>
  <div class="w-100 mt-2">
    <div class="w-100 mt-3">
      <div class="w-100 table-responsive mt-4">
          <table class="table table-stripped table-bordered">
            <thead class="bg-primary text-white">
              <tr>
                <td>No</td>
                <td>Name</td>
                <td>Type</td>
                <td>Place Name</td>
                <td>Price Monthly</td>
                <td>Price Daily</td>
                <td>Total Transaction</td>
                <td>Available</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              @foreach($rooms as $key => $item)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }} </td>
                <td>{{ $item->type }} </td>
                <td>{{ $item->place_name }} </td>
                <td>{{ $item->price_monthly }} </td>
                <td>{{ $item->price_daily }} </td>
                <td>{{ $item->total_transaction }} IDR</td>
                <td>{{ $item->is_available ? 'Available' : 'Unavailable' }} </td>
                <td>
                  <a href="/rooms/{{ $item->id }}">Detail</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
    <div class="w-100 d-flex">
      <a href="/user/transactions" class="text-center btn-link text-decoration-none">View All</a>
    </div>
    
  </div>
@endSection