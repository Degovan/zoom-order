@extends('layouts.admin.app')

@section('content')
<div class="row py-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.pricings.update', $pricing->id) }}" method="post">
                    <x-admin.pricing.form :pricing="$pricing" method="put" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
