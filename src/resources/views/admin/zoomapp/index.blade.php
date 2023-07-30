@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Zoom App</h1>
        <p class="mb-0">Daftar aplikasi zoom anda.</p>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('admin.zoom.app.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <table class="table table-striped table-hover" id="zoomapp-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Client ID</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<x-datatables/>
@endsection

@push('script')
<script>
$('#zoomapp-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: `{{ route('admin.zoom.app.datatables') }}`
    },
    columns: [
        {data: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'name'},
        {data: 'client_id'},
        {render: (data, type, row, meta) => {
            return `
            <div class="d-flex">
                <a href="${row.detail_url}/edit" class="btn btn-sm btn-info" title="edit">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <form action="${row.detail_url}" method="post" class="ms-1">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" title="hapus">
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
