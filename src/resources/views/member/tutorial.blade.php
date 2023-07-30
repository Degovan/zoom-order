@extends('layouts.member.app')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $tutorial->title }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">tutorial</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="section mt-5">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        {!! $tutorial->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
