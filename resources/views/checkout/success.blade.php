@extends('layouts.auth')
<style>
  .py-5 {
	padding: 20px 30px 20px;
	border: 1px solid #ddd;
	border-radius: 5px;
	box-sizing: border-box;
	background-color: #ffffff;
}
</style>
@section('content')
<div class="login-form">   
    <i class='bx bxs-check-circle h1 py-0 my-0 text-success'></i>
    <h2 class="text-dark fw-bold">Pembayaran Berhasil</h2>
    <h5 class="mt-4">Detail Pemesanan </h5>
    <table class="table">
    <tr>
        <td>ID Transaksi   </td>
        <td>:</td>
        <td>INV{{$transaction->id}} </td>
      </tr>
      <tr>
        <td>Waktu Transaksi</td>
        <td>:</td>
       s <td>{{ $transaction->created_at }} </td>
      </tr>
      <tr>
        <td>Bank </td>
        <td>:</td>
        <td>{{ $transaction->bank }} </td>
      </tr>
      <tr>
        <td>Nama </td>
        <td>:</td>
        <td>{{ $transaction->account_name }} </td>
      </tr>
      <tr>
        <td>Nomor Akun </td>
        <td>:</td>
        <td>{{ $transaction->account_number }} </td>
      </tr>
      <tr>
        <td>Lama Penyewaan </td>
        <td>:</td>
        <td>{{ $transaction->days > 0 ? $transaction->days : $transaction->months }} {{ $transaction->days > 0 ? 'Hari' : 'Bulan' }} </td>
      </tr>
      <tr>
        <td>Jumlah </td>
        <td>:</td>
        <td>IDR {{ $transaction->total+$transaction->id }} </td>
      </tr>
    </table>
    <div class="d-grid gap-4 d-md-block">
    <a class="btn btn-primary btn-lg" href="../user/transactions" role="button">Buka Dashboard</a>
    <a class="btn btn-secondary btn-lg" href="#">Kembali ke Home</a>
  </div>
  </div>
@endSection
