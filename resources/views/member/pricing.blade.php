@extends('layouts.member.app')

@push('style')
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.0/dist/full.css" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pricing</h3>
                <p>Sewa Zoom Meeting merupakan alternatif bagi Anda yang membutuhkan virtual meeting yang insidentil atau tidak rutin sehingga sewa zoom adalah pilihan tepat bagi Anda.</p>
                {{-- <p class="text-subtitle text-muted">We use 'simple-datatables' made by @fiduswriter. You can
                    check the full documentation <a
                        href="https://github.com/fiduswriter/Simple-DataTables/wiki">here</a>.</p> --}}
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
                    <div class="row align-items-center">
                        {{-- meeting card pricing --}}
                        <div class="col-md-4 px-0">
                            <div class="card shadow-md">
                                <div class="card-header text-center card-highlighted">
                                    <p class='text-center font-bold text-1xl text-white'>Full 1 Hari</p>
                                    <h4 class='card-title mt-0 '>Zoom Meeting</h4>
                                    <p class='text-center mt-0 text-white'>Sampai pukul <span class="font-bold">24.00</span></p>
                                </div>
                                <br>
                                <p class="text-center font-bold">Pilih Kapasitas Peserta</p>
                                <div class=" grid grid-cols-2 mx-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="100" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                          100 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" value="300" name="flexRadioDefault" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          300 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" value="500" name="flexRadioDefault" id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                          500 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" value="1000" name="flexRadioDefault" id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                          1000 Peserta
                                        </label>
                                      </div>
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
                                     <div class="item-meeting">
                                        <div class="text-center mt-4">
                                            <div class="wrapping-harga">
                                                <p class="text-decoration-line-through text-red-600">Rp.79.900</p>
                                                <h2 class="font-bold">Rp.49.000</h2>
                                                <p>Max <span class="font-bold">300</span> peserta</p>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="item-meeting">
                                        <div class="text-center mt-4">
                                            <div class="wrapping-harga">
                                                <p class="text-decoration-line-through text-red-600">Rp.99.900</p>
                                                <h2 class="font-bold">Rp.79.000</h2>
                                                <p>Max <span class="font-bold">500</span> peserta</p>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="item-meeting">
                                        <div class="text-center mt-4">
                                            <div class="wrapping-harga">
                                                <p class="text-decoration-line-through text-red-600">Rp.179.000</p>
                                                <h2 class="font-bold">Rp.159.000</h2>
                                                <p>Max <span class="font-bold">1000</span> peserta</p>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                                 <br><br>
                                <ul class="mt-10">
                                    <li><i data-feather="check-circle"></i>Host key</li>
                                    <li><i data-feather="check-circle"></i>Support Co-Host </li>
                                    <li><i data-feather="check-circle"></i>Unlimited Time</li>
                                    <li><i data-feather="check-circle"></i>Breakout Room</li>
                                    <li><i data-feather="check-circle"></i>Live Streaming Youtube / Facebook</li>
                                    <li><i data-feather="check-circle"></i>Custom Metting Topic</li>
                                    <li><i data-feather="check-circle"></i>Record To Laptop / PC</li>
                                    <li><i data-feather="check-circle"></i>Participant Passcode</li>
                                    <li><i data-feather="check-circle"></i>Waiting Room</li>
                                    <li><i data-feather="check-circle"></i>And other Zoom Features</li>
                                    <li><i data-feather="check-circle"></i>Full Support CS</li>
                                    <li><i data-feather="check-circle"></i>Guaranted 100%</li>
                                </ul>
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block">Booking disini</button>
                                </div>
                            </div>
                        </div>
                        {{-- webinar card pricing --}}
                        <div class="col-md-4 px-0">
                            <div class="card shadow-md">
                                <div class="card-header text-center card-highlighted">
                                    <p class='text-center font-bold text-1xl text-white mx'>Full 1 Hari</p>
                                    <h4 class='card-title mt-0 text-white'>Zoom Webinar</h4>
                                    <p class='text-center mt-0 text-white'>Sampai pukul <span class="font-bold">24.00</span></p>
                                </div>
                                <br>
                                <p class="text-center font-bold">Pilih Kapasitas Peserta</p>
                                <div class=" grid grid-cols-2 mx-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioWebinar" id="flexRadioWebinar1" checked>
                                        <label class="form-check-label " for="flexRadioWebinar1">
                                          500 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioWebinar" id="flexRadioWebinar2">
                                        <label class="form-check-label " for="flexRadioWebinar2">
                                          1000 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioWebinar" id="flexRadioWebinar3">
                                        <label class="form-check-label " for="flexRadioWebinar3">
                                          3000 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioWebinar" id="flexRadioWebinar4">
                                        <label class="form-check-label " for="flexRadioWebinar4">
                                          5000 Peserta
                                        </label>
                                      </div>
                                 </div>
                                 <div class="item-webinar">
                                     <div class="text-center mt-4">
                                         <div class="wrapping-harga">
                                             <p class="text-decoration-line-through ">Rp.949.000</p>
                                             <h2 class="font-bold ">Rp.549.900</h2>
                                             <p class="">Max <span class="font-bold text-green-500">500</span> Peserta</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="item-webinar">
                                    <div class="text-center mt-4">
                                        <div class="wrapping-harga">
                                            <p class="text-decoration-line-through ">Rp.1.149.000</p>
                                            <h2 class="font-bold ">Rp.749.900</h2>
                                            <p class="">Max <span class="font-bold text-green-500">1000</span> Peserta</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-webinar">
                                    <div class="text-center mt-4">
                                        <div class="wrapping-harga">
                                            <p class="text-decoration-line-through ">Rp.1.409.000</p>
                                            <h2 class="font-bold ">Rp1.090.900</h2>
                                            <p class="">Max <span class="font-bold text-green-500">3000</span> Peserta</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-webinar">
                                    <div class="text-center mt-4">
                                        <div class="wrapping-harga">
                                            <p class="text-decoration-line-through ">Rp.1.890.000</p>
                                            <h2 class="font-bold ">Rp1.590.900</h2>
                                            <p class="">Max <span class="font-bold text-green-500">5000</span> Peserta</p>
                                        </div>
                                    </div>
                                </div>
                                 <br><br>
                                <ul class="mt-10">
                                    <li><i data-feather="check-circle"></i>Akses Akun H-1</li>
                                    <li><i data-feather="check-circle"></i>Support Branding</li>
                                    <li><i data-feather="check-circle"></i>Attendee Registration</li>
                                    <li><i data-feather="check-circle"></i>Host Controls</li>
                                    <li><i data-feather="check-circle"></i>Question & Answer</li>
                                    <li><i data-feather="check-circle"></i>Raise Hand & Chat</li>
                                    <li><i data-feather="check-circle"></i>Recording & Reporting</li>
                                    <li><i data-feather="check-circle"></i>Live Streaming Youtube</li>
                                    <li><i data-feather="check-circle"></i>Custom Webinar Topic</li>
                                    <li><i data-feather="check-circle"></i>And other Zoom Features</li>
                                    <li><i data-feather="check-circle"></i>Full Support CS</li>
                                    <li><i data-feather="check-circle"></i>Guaranted 100%</li>
                                </ul>
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block">Booking disini</button>
                                </div>
                            </div>
                        </div>
                        {{-- pro card pricing --}}
                        <div class="col-md-4 px-0">
                            <div class="card shadow-md">
                                <div class="card-header text-center background-gold">
                                    <p class='text-center font-bold text-1xl text-white'> Durasi 30 Hari</p>
                                    <h4 class='card-title mt-0 text-white'>Lisensi PRO</h4>
                                    <p class='text-center mt-0 text-white'>Invite member bulanan</p>
                                </div>
                                <br>
                                <p class="text-center font-bold">Pilih Kapasitas Peserta</p>
                                <div class="mx-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioPro" id="flexRadioPro1" checked>
                                        <label class="form-check-label " for="flexRadioPro1">
                                          100 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioPro" id="flexRadioPro2">
                                        <label class="form-check-label " for="flexRadioPro2">
                                          300 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioPro" id="flexRadioPro3">
                                        <label class="form-check-label " for="flexRadioPro3">
                                          500 Peserta
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioPro" id="flexRadioPro4">
                                        <label class="form-check-label " for="flexRadioPro4">
                                          1000 Peserta
                                        </label>
                                      </div>
                                 </div>
                                 <div class="item-zoompro">
                                     <div class="text-center mt-4">
                                         <div class="wrapping-harga">
                                             <p class="text-gray-900">27 Februari 2022</p>
                                             {{-- <p class="text-decoration-line-through ">Rp.949.000</p> --}}
                                             <h2 class="font-bold ">Rp.199.900</h2>
                                             <p class="">Max <span class="font-bold text-green-500">100</span> Peserta</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="item-zoompro">
                                    <div class="text-center mt-4">
                                        <div class="wrapping-harga">
                                            <p class="text-gray-900">27 Februari 2022</p>
                                            {{-- <p class="text-decoration-line-through ">Rp.949.000</p> --}}
                                            <h2 class="font-bold ">Rp.349.900</h2>
                                            <p class="">Max <span class="font-bold text-green-500">300</span> Peserta</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-zoompro">
                                    <div class="text-center mt-4">
                                        <div class="wrapping-harga">
                                            {{-- <p class="text-gray-900">27 Februari 2022</p> --}}
                                            <p class="text-decoration-line-through ">Rp.749.000</p>
                                            <h2 class="font-bold ">Rp.549.900</h2>
                                            <p class="">Max <span class="font-bold text-green-500">500</span> Peserta</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-zoompro">
                                    <div class="text-center mt-4">
                                        <div class="wrapping-harga">
                                            {{-- <p class="text-gray-900">27 Februari 2022</p> --}}
                                            <p class="text-decoration-line-through ">Rp.949.000</p>
                                            <h2 class="font-bold ">Rp.749.900</h2>
                                            <p class="">Max <span class="font-bold text-green-500">1000</span> Peserta</p>
                                        </div>
                                    </div>
                                </div>
                                 <br><br>
                                <ul class="mt-10">
                                    <li><i data-feather="check-circle"></i>Anti Disabled</li>
                                    <li><i data-feather="check-circle"></i>Co-Host</li>
                                    <li><i data-feather="check-circle"></i>Unlimited Time</li>
                                    <li><i data-feather="check-circle"></i>Breakout Room</li>
                                    <li><i data-feather="check-circle"></i>Live Streaming Youtube / Facebook</li>
                                    <li><i data-feather="check-circle"></i>Custom meeting topic</li>
                                    <li><i data-feather="check-circle"></i>Record To Laptop / PC</li>
                                    <li><i data-feather="check-circle"></i>Participant Passcode</li>
                                    <li><i data-feather="check-circle"></i>Waiting Room</li>
                                    <li><i data-feather="check-circle"></i>And others ZOOM Features</li> 
                                    <li><i data-feather="check-circle"></i>Full Support CS</li>
                                    <li><i data-feather="check-circle"></i>Guaranted 100%</li>
                                </ul>
                                <div class="card-footer">
                                    <button class="btn background-gold btn-block font-bold">Order disini</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
</section>
@endsection

@push('script')
    <script src="/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>

        // zoom meeting
        $('[name=flexRadioDefault]').each(function(i,d){
  var p = $(this).prop('checked');
//   console.log(p);
  if(p){
    $('.item-meeting').eq(i)
      .addClass('on');
  }    
});  

$('[name=flexRadioDefault]').on('change', function(){
  var p = $(this).prop('checked');
  
  // $(type).index(this) == nth-of-type
  var i = $('[name=flexRadioDefault]').index(this);
  
  $('.item-meeting').removeClass('on');
  $('.item-meeting').eq(i).addClass('on');
});

// endd

// zoom webinar

$('[name=flexRadioWebinar]').each(function(i,d){
  var p = $(this).prop('checked');
//   console.log(p);
  if(p){
    $('.item-webinar').eq(i)
      .addClass('on');
  }    
});  

$('[name=flexRadioWebinar]').on('change', function(){
  var p = $(this).prop('checked');
  
  // $(type).index(this) == nth-of-type
  var i = $('[name=flexRadioWebinar]').index(this);
  
  $('.item-webinar').removeClass('on');
  $('.item-webinar').eq(i).addClass('on');
  
});
// endd

// zoom pro

$('[name=flexRadioPro]').each(function(i,d){
  var p = $(this).prop('checked');
//   console.log(p);
  if(p){
    $('.item-zoompro').eq(i)
      .addClass('on');
  }    
});  

$('[name=flexRadioPro]').on('change', function(){
  var p = $(this).prop('checked');
  
  // $(type).index(this) == nth-of-type
  var i = $('[name=flexRadioPro]').index(this);
  
  $('.item-zoompro').removeClass('on');
  $('.item-zoompro').eq(i).addClass('on');
  
});
// endd

    </script>
@endpush
