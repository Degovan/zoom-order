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
            <div class="card w-100 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{asset('invoice/img/RapatVirtual.png')}}" class="logo-invoice"
                                alt="RapatVirtual (Logo Horizontal)">
                            <div class="mt-5">
                                <p><b>PT. Furqan Digital Niaga</b></p>
                                <p>Pondok Ungu Permai Block LL 1 No 26 Bekasi Utara, Kota Bekasi. 17125</p>
                                <p>NPWP: 63.509.570.6-407.000 </p>
                                <p>Telp. 0877-3249-8274</p>
                            </div>
                            <div class="mb-5">
                                <p class=" text-muted">Bill To:</p>
                                <p><b>{{ $invoice->user->name }}</b></p>
                                <p>{{ $invoice->user->institution }}</p>
                                <p>{{ $invoice->user->full_address }}</p>

                            </div>
                        </div>
                        <div class="col-md-7 text-end ">
                            <h1 class="font-normal">INVOICE</h1>
                            <h5 class="font-normal text-muted "># inv{{ $invoice->code }}</h5>
                            <span class="badge" id="invoice-status">{{ $invoice->status }}</span>
                            <br />
                            <table class="table mt-5 w-100 float-end table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Date: </td>
                                        <td>{{ $invoice->created_at->format('d/m/Y') }}</td>

                                    </tr>
                                    <tr>
                                        <td>Due Date: </td>
                                        <td>{{ $invoice->due->diffForHumans() }}</td>
                                    </tr>
                                    <tr class="table-light">

                                        <td><b>Balance Due:</b></td>
                                        <td>
                                            @if ($invoice->status == 'unpaid')
                                            <b>@money($invoice->total, 'IDR')</b>
                                            @else
                                            <b>@money(0, 'IDR')</b>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="table-dark">
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col" class="text-end">Rate</th>
                                    <th scope="col" class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <b>{{ $invoice->items->title }}</b><br>
                                        Pilih Kapasitas: {{ $invoice->items->max_audience }} Attendee
                                    </td>
                                    <td>{{ $invoice->items->packets }}</td>
                                    <td class="text-end">@money($invoice->items->cost, 'IDR')</td>
                                    <td class="text-end">@money($invoice->total, 'IDR')</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5 row">
                        <div class="col-md-5">
                            <img src="{{ asset('/invoice/img/sign.jpeg')}}" class="signature mt-5" alt="" />
                        </div>
                        <div class="col-md-7 float-end">
                            <table class="table mt-5 w-100 float-end table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="text-muted">Subtotal: </td>
                                        <td class="text-end">@money($total * $invoice->items->packets, 'IDR')</td>

                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tax(0%):</td>
                                        <td class="text-end">IDR 0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Total:</td>
                                        <td class="text-end">@money($total * $invoice->items->packets, 'IDR')</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Amount Paid:</td>
                                        @if ($invoice->status == 'complete')
                                        <td class="text-end">@money($total * $invoice->items->packets, 'IDR')</td>
                                        @else
                                        <td class="text-end">@money(0, 'IDR')</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($invoice->status == 'unpaid')
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary">
                    <p class="text-white">Total due</p>
                    <h2 class="text-white">@money($invoice->total)</h2>
                    <p class="text-white mt-3">Payment method: </p>
                    <button type="button" class="button w-full box-border btn-custom mt-2 fw-bold">
                        <a href="{{ $invoice->payment_url }}">Proceed To Payment</a>
                    </button>
                </div>
            </div>
            <div class="mt-4">
                <h4>Actions</h4>
                <a href="{{ route('member.invoice.print', $invoice)}}"><svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path
                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path
                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Download</a>
            </div>
        </div>
        @endif
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
</script>
@endpush
