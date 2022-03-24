@extends('layouts.member.app')

@push('style')
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
@endpush

@section('content')
@php
$total = ($invoice->items->cost - $invoice->items->discount);
@endphp
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card shadow-none border">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-7">
                            <h1>Invoice #{{ $invoice->code }} <span class="badge" id="invoice-status">UNPAID</span></h1>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="fw-bold">Invoice date</p>
                                </div>
                                <div class="col-md-4">
                                    <p>{{ $invoice->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-5">
                                    <p class="fw-bold">Due Date</p>
                                </div>
                                <div class="col-md-5">
                                    <p>{{ $invoice->due->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-7">
                            <div class="text-wrapper">
                                <h3>Pay to:</h3>
                                <p class="mt-3">PT. Furqan digital indonesia</p> 
                                <p>NPWP : 00.000.000.0000.000</p>
                                <p >Jl. Rowosari RT 04 RW 05. Meteseh, Kec Boja, Kabupaten Kendal, Jawa Tengah</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3>Invoiced to : </h3>
                            <p class="mt-3">{{ $invoice->user->institution }}</p>
                            <p class="fw-normal">{{ $invoice->user->name }}</p>
                            <p class="max-w-2xl ml-0">{{ $invoice->user->full_address }}</p>
                        </div>
                    </div>

                    <div class="table-wrapper mt-5">
                        <h4 class="fw-bold">Invoice Item</h4>
                        <table class="table mt-3">
                            <thead>
                                <td class="fw-bold">Decription</td>
                                <td class="fw-bold">Amount</td>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $invoice->items->title }}</td>
                                    <td>Rp. {{ $total }}</td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td>{{ $invoice->items->days }} hari</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row justify-content-end">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-right">Total</th>
                                        <th>Rp. {{ $total * $invoice->items->days }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary">
                        <p class="text-white">Total due</p>
                        <h2 class="text-white">Rp. {{ $invoice->total }}</h2>
                        <p class="text-white mt-3">Payment method: </p>
                        <button type="button" class="button w-full box-border btn-custom mt-2 fw-bold">
                            <a href="{{ $invoice->payment_url }}">Proceed To Payment</a>
                        </button>
                    </div>
                </div>
                <div class="mt-4">
                    <h4>Actions</h4>
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>  Download</a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

@push('script')
<script src="/vendor/simple-datatables/simple-datatables.js"></script>
<script>
const status = document.getElementById('invoice-status');

switch(status.innerText.toLowerCase()) {
    case 'unpaid':
            status.classList.add('bg-danger');
        break;
    case 'active':
            status.classList.add('bg-success');
        break;
    case 'complete':
            status.classList.add('bg-danger');
        break;
}
</script>
@endpush
