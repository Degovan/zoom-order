@extends('layouts.admin.app')

@section('content')
<div class="row py-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <x-admin.pricing.form/>
            </div>
        </div>
    </div>
</div>
@endsection
