@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Edit Tutorial</h1>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <x-admin.tutorial.form method="put" :route="route('admin.tutorials.update', $tutorial->id)" :tutorial="$tutorial" />
            </div>
        </div>
    </div>
</div>
@endsection
