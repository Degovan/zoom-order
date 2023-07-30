@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Zoom App</h1>
        <p class="mb-0">Edit detail aplikasi zoom.</p>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.zoom.app.update', $zoomApp) }}" method="post">
                    @method('PATCH')
                    <x-admin.zoomapp.form :zoomApp="$zoomApp" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
