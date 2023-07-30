@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Paket (pricing)</h1>
        <p class="mb-0">Daftar paket harga yang tersedia untuk member.</p>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('admin.pricings.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Paket
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="pricing-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tagline</th>
                                <th>Ringkasan</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Aksi</th>
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
    $('#pricing-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.pricings.datatables') }}'
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title'},
            {data: 'summary'},
            {data: 'cost'},
            {data: 'discount'},
            {render: (data, type, row, meta) => {
                return `
                    <div class="d-flex">
                    <a href="${row.editUrl}" class="btn text-white btn-success btn-sm">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="${row.delUrl}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm ms-1">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                    </div>
                `;
            }}
        ]
    });
</script>
@endpush
