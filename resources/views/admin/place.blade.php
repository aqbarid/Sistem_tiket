@extends('layouts.admin')

@section('content')
  <div class="w-100 mt-5">
    <h3>Places <span class="text-primary">{{ $totalPlace }}</span></h3>
  </div>
  <div class="w-100 mt-2">
    <div class="w-100 mt-3">
      <div class="w-100 table-responsive mt-4">
          <table class="table table-stripped table-bordered">
            <thead class="bg-primary text-white">
              <tr>
                <td>No</td>
                <td>Name</td>
                <td>Owner</td>
                <td>Contact</td>
                <td>Total Transaction</td>
                <td>Total Income</td>
                <td>Total Room</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              @foreach($places as $key => $item)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }} </td>
                <td>{{ $item->user_name }} </td>
                <td>{{ $item->contact }} </td>
                <td>{{ $item->total_transaction }} </td>
                <td>{{ $item->total_income ?? '0' }} IDR</td>
                <td>{{ $item->total_room }} </td>
                <td>
                  <a href="/place/{{ $item->id }}">Detail</a>
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