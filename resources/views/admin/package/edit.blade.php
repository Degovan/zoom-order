@extends('layouts.admin.app')

@section('content')
<form action="{{ route('admin.packages.update', $package->id) }}" method="post">
    <x-admin.package.form :package="$package" :pricings="$package->pricings" method="put" />
</form>
@endsection
