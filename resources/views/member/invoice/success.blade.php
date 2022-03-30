@extends('layouts.member.auth')

@push('style')
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
@endpush

@section('title', 'paysuccess')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                     <span class="text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                          </svg>
                     </span>
                    <h2 class="fw-normal text-success mt-3">Transaksi Berhasil</h2>
                </div>
                <div class="card-body mt-2">
                    <div class="row gx-5">
                        <div class="col text-start">
                             <p class="fw-bold">Payment type</p>
                             <p class="fw-bold">Channel</p>
                             <p class="fw-bold">Mobile</p>
                             <p class="fw-bold">Email</p>
                             <p class="fw-bold mt-5 text-muted">Amount paid</p>
                             <p class="fw-bold mt-2">Transaction id</p>
                        </div>
                        <div class="col text-end">
                            <p>{{ $xInvoice->payment_method }}</p>
                            <p>{{ $xInvoice->payment_channel }}</p>
                            <p>{{ $invoice->user->phone }}</p>
                            <p>{{ $invoice->user->email }}</p>
                            <p class="fw-bold mt-5">@money($invoice->total)</p>
                            <p class="fw-bold mt-2">#{{ $invoice->code }}</p>
                       </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('member.invoice.print', $invoice)}}" class="btn btn-primary w-full">Cetak</a>
                    <a href="{{ route('member.invoice.show', $invoice) }}" class="btn btn-primary w-full">Tutup</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
