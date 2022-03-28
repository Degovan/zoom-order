@extends('layouts.member.app')

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
                <table class="table table-striped hover invoice-table" id="invoice-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id Invoice</th>
                            <th>Due</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>

    </section>
</div>
<x-datatables/>
@endsection
@push('script')

<script type="text/javascript">
$('#invoice-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('member.invoice.datatables') }}'
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'code'},
            {data: 'due' },
            {data: 'total'},
            {render: (data, type, raw, meta) => {

                const value = raw.status.toLowerCase();
                const bg = (value == 'unpaid') ? 'bg-danger' : (value == 'active') ? 'bg-success' : (value == 'complete') ? 'bg-info' : '';

                return `<a href='/member-area/invoice/${raw.code}' class='badge ${bg}'>${value}</a>`;
            }}
        ],
    });
</script>
@endpush
