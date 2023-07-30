@extends('layouts.member.app')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Zoom Meetings</h3>
                <p class="text-subtitle text-muted">Daftar zoom meeting yang aktif ataupun yang telah terlewat</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('member.meetings.choose') }}" class="btn btn-primary"><i data-feather="plus-square" width="20"></i> Buat Meeting</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="meetings-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Topik</th>
                                <th>Waktu</th>
                                <th>Selesai</th>
                                <th>Password</th>
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
const tbl = $('#meetings-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('member.meetings.dt') }}'
    },
    columns: [
        {data: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'topic'},
        {data: 'start'},
        {data: 'end'},
        {data: 'passcode'},
        {render: (data, type, row, meta) => {
            const href = document.location;

            return `
                <a href="${href}/${row.id}" title="detail" class="btn btn-sm btn-primary">
                    <i data-feather="eye"></i>
                </a>
                <a href="${href}/${row.id}/start" title="start" class="btn btn-sm btn-success ${(row.status == 'finish') ? 'd-none' : ''}">
                    <i data-feather="play"></i>
                </a>
            `;
        }}
    ]
});

tbl.on('draw', () => {
    feather.replace();
});
</script>
@endpush
