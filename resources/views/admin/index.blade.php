@extends('layouts.admin')

@section('content')
  <div class="w-100">
    <div class="card p-3 bg-primary">
      <h2 class="text-dark fw-bold text-white mt-3 mb-3">Welcome back {{ $user->name }}</h2>
    </div>
    <div class="row mt-4">
      <div class="col-md-3">
        <div class="card bg-primary text-white">
          <div class="p-3">
            <h3>{{ $totalRoom }}</h3>
            <p>Total Rooms</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-primary text-white">
          <div class="p-3">
            <h3>{{ $totalTransaction }}</h3>
            <p>Total Transactions</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-primary text-white">
          <div class="p-3">
            <h3>{{ $totalIncome ?? '0' }} IDR</h3>
            <p>Total Income</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-primary text-white">
          <div class="p-3">
            <h3>{{ $totalWaiting }}</h3>
            <p>Waiting To Check</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-100 mt-5">
    <h3>Last Transactions</h3>
  </div>
  <div class="w-100 mt-2">
    <div class="w-100 mt-3">
      <div class="w-100 table-responsive mt-4">
          <table class="table table-stripped table-bordered">
            <thead class="bg-primary text-white">
              <tr>
                <td>No</td>
                <td>Kamar</td>
                <td>Waktu</td>
                <td>Status</td>
                <td>Expired</td>
                <td>Total</td>
              </tr>
            </thead>
            <tbody>
              @foreach($transactions as $key => $item)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->room_name }} - {{ $item->place_name }} </td>
                <td>{{ $item->days ? $item->days :  $item->months }} {{ $item->days ? 'hari' : 'Bulan' }} </td>
                <td>{{ $item->status ?? '-' }}</td>
                <td>{{ $item->expired_at ?? '-' }}</td>
                <td>Rp.{{ $item->total}}</td>
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