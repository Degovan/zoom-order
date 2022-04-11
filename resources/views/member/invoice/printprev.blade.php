@extends('layouts.member.print')

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
                            <h1>Invoice #{{ $invoice->code }} <span class="badge" id="invoice-status">{{ $invoice->status }}</span></h1>
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
                                    <td>@money($total)</td>
                                </tr>
                                <tr>
                                    <td>Paket</td>
                                    <td>{{ $invoice->items->packets }} paket</td>
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
                                        <th>@money($total * $invoice->items->packets)</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
            status.classList.add('bg-info');
        break;
}

window.print()
</script>
@endpush
