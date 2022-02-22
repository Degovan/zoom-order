@extends('layouts.member.app')


@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Layout</h3>
                    <p class="text-subtitle text-muted">There's a lot of form layout that you can use</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Layout</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>

        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                        <h4 class="card-title">Vertical Form</h4>
                        </div>
                        <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical">
                                @include('member.pricing.partials.form-control')
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


