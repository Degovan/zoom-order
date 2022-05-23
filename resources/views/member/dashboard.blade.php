@extends('layouts.member.app')

@push('style')
    <link rel="stylesheet" href="/vendor/chartjs/Chart.min.css">
@endpush

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<div class="row mb-4">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Pemesanan Terakhir</h4>
            </div>
            <div class="card-body px-0 pb-0">
                <div class="table-responsive">
                    <table class='table mb-0' id="table1">
                        <thead>
                            <tr>
                                <th>Paket</th>
                                <th>Harga Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastOrders as $lastOrder)
                            <tr>
                                <td>{{ $lastOrder->items->title }}</td>
                                <td>@money($lastOrder->total)</td>
                                <td>{{ $lastOrder->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tutorial</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <i data-feather="package"></i> Pemesanan paket
                    </li>
                    <li class="list-group-item">
                        <i data-feather="video"></i> Pembuatan zoom meeting
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('script')
<script src="/vendor/chartjs/Chart.min.js"></script>
<script src="/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/vendor/voler/js/pages/dashboard.js"></script>
@endpush
