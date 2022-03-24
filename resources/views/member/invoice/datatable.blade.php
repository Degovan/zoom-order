@extends('layouts.member.app')

@push('style')
    {{-- datatables --}}
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
@endpush

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Invoices</h3>
                <p class="text-subtitle text-muted">

                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Invoices</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                {{-- Simple Datatable --}}
            </div>
            <div class="card-body">
                <table class='table table-striped hover' id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Code</th>
                            <th>Xendit_inv</th>
                            <th>Due</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$invoice->code}}</td>
                                <td>{{$invoice->xendit_inv}}</td>
                                <td>{{$invoice->due}}</td>
                                <td>{{$invoice->user->name}}</td>
                                <td>@money($invoice->total)</td>
                                <td>
                                    <button class="btn btn-danger">{{$invoice->status}}</button>
                                </td>
                                <td>
                                    <a href="#">Bayar Bang</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection

@push('script')
<script src="/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/vendor/js/vendors.js"></script>
@endpush
