@extends('layouts.admin')

@section('content')

<span>{{ $transaction->status }}</span>


<br>

@if( $transaction->status == 'checking')
<form method="post" action="/admin/transaction/change/{{ $transaction->transaction_id }}/confirmed">
    <button class="btn btn-primary" type="submit">Confirm</button>
</form>
@endif

@endSection