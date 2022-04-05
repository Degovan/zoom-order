@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Zoom Account</h1>
        <p class="mb-0">Daftar akun zoom yang telah terhubung pada aplikasi.</p>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ $auth_url }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-paperclip"></i> Hubungkan akun baru
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="zoom-account-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Kapasitas</th>
                                <th>Action</th>
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
    $('#zoom-account-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.zoom.account.datatables') }}'
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'email'},
            {data: 'capacity'},
            {render: (data, type, row, meta) => {
                return `
                    <div class="d-flex">
                        <a href="${row.editUrl}" class="btn btn-sm btn-success me-1">
                            <i class="fas fa-pencil-alt text-white"></i>
                        </a>
                        <form action="${row.delUrl}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
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
