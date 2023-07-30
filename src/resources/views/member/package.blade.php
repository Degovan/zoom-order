@extends('layouts.member.app')

@push('style')
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
@endpush

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Harga Paket</h3>
                <p>Sewa Zoom Meeting merupakan alternatif bagi Anda yang membutuhkan virtual meeting yang insidentil atau tidak rutin sehingga sewa zoom adalah pilihan tepat bagi Anda.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">paket</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section mt-5">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="pricing">
                    <div class="row align-items-center mt-4">
                        @foreach($packages as $pkg)
                        @php
                            $fPrice = $pkg->pricings[0];
                        @endphp
                        <div class="col-md-6 col-lg-4 px-0">
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
                                        <input class="form-check-input pricing-list" type="radio" id="pr{{ $pricing->id }}" name="pricing{{ $pkg->id }}" value="{{ $pricing->cost }}" data-disc="{{ $pricing->discount }}" data-aud="{{ $pricing->max_audience }}" @if($loop->first) checked @endif>
                                        
                                        <label class="form-check-label" for="pr{{ $pricing->id }}">
                                            {{ $pricing->max_audience }} Peserta
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="pricing-list">
                                    <div class="item-meeting on">
                                        <div class="text-center mt-4">
                                            <div class="wrapping-harga">
                                                <p class="text-decoration-line-through text-red-600 pricing-disc" id="pricing{{ $pkg->id }}-disc">
                                                    {{ ($fPrice->discount != 0) ? 'Rp ' . $fPrice->cost : '' }}
                                                </p>
                                                <h2 class="font-bold pricing-cost" id="pricing{{ $pkg->id }}-cost">
                                                    Rp {{ $fPrice->cost - $fPrice->discount }}
                                                </h2>
                                                <p>
                                                    Max <span class="font-bold" id="pricing{{ $pkg->id }}-audience">{{ $fPrice->max_audience }}</span> peserta
                                                </p>
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
                                    <a href="/member-area/booking/{{ "$pkg->id/$fPrice->id" }}" class="btn btn-primary btn-block" id="pricing{{ $pkg->id }}-href">Booking disini</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function formatRupiah(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function formatRupiahEl(element) {
    element.forEach((item, i) => {
        if(item.innerText.length == 0) return;

        const value = parseInt(item.innerText.match(/\d+/g));
        item.innerText = `Rp ${formatRupiah(value)}`;
    });
}

$('.pricing-list').on('change', function() {
    const aud = $(this).data('aud');
    const pid = $(this).attr('name');
    const cost = parseInt($(this).val());
    const disc = parseInt($(this).data('disc'));
    const id = $(this).attr('id');

    $(`#${pid}-cost`).text(`Rp ${formatRupiah(cost - disc)}`);
    $(`#${pid}-disc`).text(disc == 0 ? '' : `Rp ${formatRupiah(cost)}`);
    $(`#${pid}-audience`).text(aud);

    const hrefText = `/member-area/booking/${pid.match(/\d+/g)}/${id.match(/\d+/g)}`;
    $(`#${pid}-href`).attr('href', hrefText)
});

formatRupiahEl(pricingCosts = document.querySelectorAll('.pricing-cost'));
formatRupiahEl(document.querySelectorAll('.pricing-disc'));

</script>
@endpush
