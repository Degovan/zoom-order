@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Tutorial</h1>
        <p class="mb-0">Daftar tutorial untuk pengguna.</p>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('admin.tutorials.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Tutorial
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="pricing-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ikon</th>
                                <th>Judul</th>
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
<script src="/vendor/voler/js/feather-icons/feather.min.js"></script>
<script>
    const table = $('#pricing-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.tutorials.dt') }}'
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {render: (data, type, row, meta) => {
                return `<i data-feather="${row.icon}" width="20"></i>`;
            }},
            {data: 'title'},
            {render: (data, type, row, meta) => {
                return `
                <div class="d-flex">
                    <a href="${row.editLink}" class="btn btn-sm btn-success text-white" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="${row.delLink}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger ms-1" title="hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
                `;
            }}
        ]
    });

    table.on('draw', () => feather.replace());
</script>
@endpush
