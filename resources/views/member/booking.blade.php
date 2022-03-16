@extends('layouts.member.app')

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
                        <input type="text" class="form-control mt-3 " placeholder="kapasitas" readonly value="{{ $pricing->max_audience }} peserta">
                    </div>
                    <div class="mb-4">
                        <label for="days">Berapa Hari</label>
                        <select class="form-select mt-3" aria-label="Default select example" name="days">
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
                    <div class="mb-4 mt-4">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control mt-3" placeholder="" name="" readonly aria-label="" value="{{ $user->name }}" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-4">
                        <label for="province">Provinsi</label>
                        <select class="form-select mt-3" id="province" disabled>
                            @foreach($region->provinces as $prov)
                            <option value="{{ $prov->id }}" {{ $prov->id == $user->province ? 'selected' : '' }}>{{ $prov->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="district">Kabupaten</label>
                        <select class="form-select mt-3" id="district" disabled>
                            @foreach($region->districts as $dist)
                            <option value="{{ $dist->id }}" {{ $dist->id == $user->district ? 'selected' : '' }}>{{ $dist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="sub-district">Kecamatan</label>
                        <select class="form-select mt-3" id="sub-district" disabled>
                            @foreach($region->sub_districts as $sub)
                            <option value="{{ $sub->id }}" {{ $sub->id == $user->sub_district ? 'selected' : '' }}>{{ $sub->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="institute">Nama Lembaga / Instansi</label>
                        <input type="text" class="form-control mt-3" id="institute" readonly value="{{ $user->institution }}">
                    </div>
                    <div>
                        <label for="phone">Nomor Whatsapp</label>
                        <input type="text" class="form-control mt-3" id="phone" readonly value="{{ $user->phone }}">
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
