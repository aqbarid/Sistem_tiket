@extends('layouts.user')

@section('content')
  <div class="w-100">
    <h2 class="text-dark fw-bold"> {{ ucfirst($type ?? 'all') }} Transactions</h2>
  </div>
  <div class="w-100 mt-3">
    <div class="w-100">
      <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="/user/transactions" type="button" class="btn {{ $type === 'all'  ? 'btn-primary' : 'btn-outline-primary'}}">All</a>
        <a href="/user/transactions?type=pending" type="button" class="btn {{ $type === 'pending'  ? 'btn-primary' : 'btn-outline-primary'}}">Pending Payment</a>
        <a href="/user/transactions?type=checking" type="button" class="btn {{ $type === 'checking'  ? 'btn-primary' : 'btn-outline-primary'}}">On Checking</a>
        <a href="/user/transactions?type=success" type="button" class="btn {{ $type === 'success'  ? 'btn-primary' : 'btn-outline-primary'}}">Success</a>
        <a href="/user/transactions?type=failure" type="button" class="btn {{ $type === 'failure'  ? 'btn-primary' : 'btn-outline-primary'}}">Failure</a>
        <a href="/user/transactions?type=canceled" type="button" class="btn {{ $type === 'canceled'  ? 'btn-primary' : 'btn-outline-primary'}}">Canceled</a>
      </div>
    </div>
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
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @foreach($transaction as $key => $item)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $item->room_name }} - {{ $item->place_name }} </td>
              <td>{{ $item->days ? $item->days :  $item->months }} {{ $item->days ? 'hari' : 'Bulan' }} </td>
              <td>{{ $item->status ?? '-' }}</td>
              <td>{{ $item->expired_at ?? '-' }}</td>
              <td>Rp.{{ $item->total}}</td>
              <td>
                @if($item->status == 'pending')
                <a href="/checkout/payment/{{ $item->id }}">Pay Now</a>
                @else
                -
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
@endSection