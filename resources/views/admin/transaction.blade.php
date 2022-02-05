@extends('layouts.admin')

@section('content')
  <div class="w-100 mt-5">
    <h3>Transactions <span class="text-primary">{{ $totalTransaction }}</span></h3>
  </div>
  <div class="w-100 mt-2">
    <div class="w-100 mt-3">
      <div class="w-100 table-responsive mt-4">
          <table class="table table-stripped table-bordered">
            <thead class="bg-primary text-white">
              <tr>
                <td>No</td>
                <td>Customer Name</td>
                <td>Room Name</td>
                <td>Admin Name</td>
                <td>Total</td>
                <td>Time</td>
                <td>Status</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              @foreach($transactions  as $key => $item)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->customer_name }} </td>
                <td>{{ $item->room_name }} </td>
                <td>{{ $item->admin_name ?? '-' }} </td>
                <td>{{ $item->total }} </td>
                <td>{{ $item->days ? $item->days :  $item->months }} {{ $item->days ? 'hari' : 'Bulan' }} </td>
                <td>{{ $item->status }} IDR</td>
                <td>
                  <a href="/admin/transaction/{{ $item->id }}">Detail</a>
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