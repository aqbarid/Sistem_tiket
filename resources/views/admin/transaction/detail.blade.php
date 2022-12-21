
@extends('layouts.admin')

@section('content')
<div class="row">
<div class="container w-50">
    <h2> Detail Transaksi #{{ $transaction->id }} </h2>
    <ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center">
        ID Transaksi
        <span >{{ $transaction->id }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        ID Pembayaran
        <span >{{ $transaction->transaction_id }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Nama Akun Bank
        <span >{{ $transaction->account_name }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Total Transaksi
        <span >{{ $transaction->total }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Bank Pembayaran
        <span >{{ $transaction->bank }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Status Transaksi
        @if($transaction->status == 'checking')
        <span class="badge badge-pill badge-primary">{{ $transaction->status }}</span>
        @elseif($transaction->status == 'pending')
        <span class="badge badge-pill badge-warning">{{ $transaction->status }}</span>
        @else
        <span class="badge badge-pill badge-secondary">{{ $transaction->status }}</span>
        @endif
    </li>
    </ul>
    <br>
    @if( $transaction->status == 'confirmed')
    <div class="card card-body">
        <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Lihat Bukti Transaksi
        </button><br>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <img src="/uploads/{{ $transaction->file }}" class="img-fluid" alt="Responsive image">
            </div>
        </div>
        @elseif( $transaction->status == 'checking')
        <p>Pembayaran belum di Konfirmasi.</p>
        <form method="post" action="/admin/transaction/change/{{ $transaction->transaction_id }}/confirmed">
        <button class="btn btn-primary" type="submit">Konfirmasi Pembayaran</button> </form>
    </div>
    @endif
</div></div>

<div class="container w-50">
<h3> Detail Ruang Yang di pesan #{{ $transaction->id }} </h3> 
<ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Nama Room
        <span >{{ $transaction->room_name }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Lokasi
        <span >{{ $transaction->place_name }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Waktu Pemesanan
        <span >{{ $transaction->created_at }}</span>
    </li>
    </ul>
</div>
</div>

@endSection