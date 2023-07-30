@extends('layouts.admin.app')

@section('content')
<form action="{{ route('admin.packages.store') }}" method="post">
    <x-admin.package.form/>
</form>
@endsection
