@extends('layouts.member.app')

@push('style')
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.0/dist/full.css" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('content')

<div class="container-fluid">
     <h1>Booking</h1>
    <div class="row mt-4">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $package->title }}</h4>
                </div>

                <div class="card-body"> 
                    <div class="mb-4">
                        <label for="">Kapasitas</label>
                        <input type="text" class="form-control mt-3 " placeholder="kapasitas" readonly aria-label="" value="{{ $pricing->max_audience }} peserta" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-4">
                        <label for="">Berapa Hari</label>
                        <select class="form-select mt-3" aria-label="Default select example">
                            @for($i = 1; $i <= 30; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                          </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold">Informasi user</h5>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Gunakan data yang berbeda?
                        </label>
                      </div>

                      <div class="mb-4 mt-4">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control mt-3" placeholder="" name="" readonly aria-label="" value="Mohammad Sahrullah" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-4">
                        <label for="">Provinsi</label>
                        <select class="form-select mt-3" disabled aria-label="Default select example">
                            <option value="">Jawa Timur</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="">Kabupaten</label>
                        <select class="form-select mt-3" disabled aria-label="Default select example">
                            <option value="">Bondowoso</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="">Kecamatan</label>
                        <select class="form-select mt-3" disabled  aria-label="Default select example">
                            <option value="" >Bondowoso</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="">Nama Lembaga / Instansi</label>
                        <input type="text" class="form-control mt-3" placeholder="" name="" readonly aria-label="" value="Degovan" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-4">
                        <label for="">Nomor Whatsapp</label>
                        <input type="text" class="form-control mt-3" placeholder="" name="" readonly aria-label="" value="0810000000" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-primary">Booking Sekarang</button>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection