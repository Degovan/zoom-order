@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"><svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"></li>
            </ol>
        </nav>
        <h2 class="h4">All Invoices </h2>
        <p class="mb-0">Your web analytics dashboard template.</p>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="invoices-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Invoice id</th>
                                <th>Due</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<x-datatables/>
@endsection

@push('script')
<script>
    $('#invoices-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.invoice.datatables') }}'
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'code'},
            {data: 'due'},
            {data: 'user_id'},
            {data: 'total'},
            {render: (data, type, raw, meta) => {
                const value = raw.status.toLowerCase();
                const bg = (value == 'unpaid') ? 'bg-danger' : (value == 'active') ? 'bg-success' : (value == 'complete') ? 'bg-info' : '';

                return `<span class='badge ${bg}'>${value}</span>`;
            }}

        ]
    });
</script>
@endpush
