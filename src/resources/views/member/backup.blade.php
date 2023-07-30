@extends('layouts.member.app')

@push('style')
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
@endpush

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pricing</h3>
                <p>Sewa Zoom Meeting merupakan alternatif bagi Anda yang membutuhkan virtual meeting yang insidentil atau tidak rutin sehingga sewa zoom adalah pilihan tepat bagi Anda.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section mt-5">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="pricing">
                    @foreach($packages as $package)
                    <div class="row align-items-center mt-4">
                        @foreach($package as $pkg)
                        <div class="col-md-4 px-0">
                            <div class="card shadow-md">
                                <div class="card-header text-center card-highlighted">
                                    <p class='text-center font-bold text-1xl text-white'>Full 1 Hari</p>
                                    <h4 class='card-title mt-0 '>{{ $pkg->title }}</h4>
                                    <p class='text-center mt-0 text-white'>Sampai pukul <span class="font-bold">24.00</span></p>
                                </div>
                                <p class="text-center mt-2 font-bold">Pilih Kapasitas Peserta</p>
                                <div class=" grid grid-cols-2 mx-auto">
                                    @foreach($pkg->pricings as $pricing)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="100" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                        
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $pricing->max_audience }} Peserta
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="pricing-list">
                                    <div class="item-meeting">
                                        <div class="text-center mt-4">
                                            <div class="wrapping-harga">
                                                <p class="text-decoration-line-through text-red-600">Rp.49.000</p>
                                                <h2 class="font-bold">Rp.29.000</h2>
                                                <p>Max <span class="font-bold">100</span> peserta</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <ul class="mt-10">
                                    @foreach($pkg->items as $item)
                                    <li><i data-feather="check-circle"></i>{{ $item }}</li>
                                    @endforeach
                                </ul>
                                <div class="card-footer">
                                    <a href="/member-area/booking/1/1">
                                        <button class="btn btn-primary btn-block">Booking disini</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    
</script>
@endpush
