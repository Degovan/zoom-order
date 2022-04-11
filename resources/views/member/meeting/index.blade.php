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
                    <a href="{{ route('member.meetings.create') }}" class="btn btn-primary"><i data-feather="plus-square" width="20"></i> Buat Meeting</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="meetings-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Topik</th>
                                <th>Waktu</th>
                                <th>Durasi</th>
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
@endsection
