@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Zoom Meeting</h1>
        <p class="mb-0">Daftar Zoom Meeting.</p>
    </div>
</div>


<div class="row py-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Akan Datang</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Berjalan</button>
                      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Selesai</button>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active mt-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>ID Meeting</th>
                                    <th>User</th>
                                    <th>Topic</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Passcode</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade mt-5" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table class="table table-bordered yajra-datatable1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>ID Meeting</th>
                                    <th>User</th>
                                    <th>Topic</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Passcode</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade mt-5" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <table class="table table-bordered yajra-datatable2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>ID Meeting</th>
                                    <th>User</th>
                                    <th>Topic</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Passcode</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>

<x-datatables/>
@endsection
@push('script')
    <script>
        $(function(){
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.meeting.ongoing')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'status', name: 'status'},
                    {data: 'zoom_meeting_id', name: 'zoom_meeting_id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'topic', name: 'topic'},
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {data: 'passcode', name: 'passcode'},
                ]
            })
        })
    </script>
    <script>
        $(function(){
            var table = $('.yajra-datatable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.meeting.running')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'status', name: 'status'},
                    {data: 'zoom_meeting_id', name: 'zoom_meeting_id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'topic', name: 'topic'},
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {data: 'passcode', name: 'passcode'},
                ]
            })
        })
    </script>
      <script>
        $(function(){
            var table = $('.yajra-datatable2').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.meeting.finish')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'status', name: 'status'},
                    {data: 'zoom_meeting_id', name: 'zoom_meeting_id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'topic', name: 'topic'},
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {data: 'passcode', name: 'passcode'},
                ]
            })
        })
    </script>
@endpush

