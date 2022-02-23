@extends('layouts.member.app')

@push('style')
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
@endpush

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>All Invoice</h3>
                {{-- <p class="text-subtitle text-muted">We use 'simple-datatables' made by @fiduswriter. You can
                    check the full documentation <a
                        href="https://github.com/fiduswriter/Simple-DataTables/wiki">here</a>.</p> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('member.pricing.create')}}" class="btn btn-primary"> Tambah</a>
        </div>
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>901024</td>
                        <td>05/01/2022</td>
                        <td>12/01/2022</td>
                        <td>Rp.231.000,00</td>
                        <td>
                            <span class="badge bg-success">Paid</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection

@push('script')
    <script src="/vendor/simple-datatables/simple-datatables.js"></script>
@endpush
