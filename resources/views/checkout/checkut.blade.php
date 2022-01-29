@extends('layouts.auth')

@section('content')
<div class="login-form">
  <form action="/checkout/payment" method="post">
    <h2>Checkout <span class="text-primary">{{ $room->name }}</span></h2>
    @error
    @success

    <img src="{{ $room->image }}" style="height: 200px; width: 100%; object-fit: cover;" alt="">
    
    <input type="hidden" name="room_id" value="{{ $room->id }}">
    <div class="w-100 mt-4 form-group">
      <label for="type" class="col-form-label">Tipe</label>
      <select name="type" id="type" class="form-control">
        <option value="monthly">Bulanan</option>
        <option value="daily">Harian</option>
      </select>
    </div>

    <div class="form-group">
      <label for="total" class="col-form-label">Jumlah </label>
      <input type="total" placeholder="10" class="form-control" name="total" >
    </div>
    <button type="submit">Payment</button>    
  </form>
</div>
@endsection