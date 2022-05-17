@extends('layouts.member.app')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pilih Paket</h3>
                <p class="text-subtitle text-muted">Berikut adalah daftar paket yang dapat anda gunakan (klik untuk memilih)</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-3">
        @foreach ($orders as $order)
        @php $invoice = $order->invoice @endphp
        <div class="col-md-4">
            <a class="card" href="/dsaom">
                <div class="card-header">
                    <h4>{{ $invoice->items->title }}</h4>
                </div>
                <div class="card-body">
                    <p>Tersisa: {{ $order->remaining }}</p>
                    <p>Kapasitas maksimal {{ $invoice->items->max_audience }} peserta</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
