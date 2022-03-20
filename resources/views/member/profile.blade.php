@extends('layouts.member.app')

@push('style')
<!-- Include Choices CSS -->
<link rel="stylesheet" href="/vendor/choices.js/choices.min.css" />
@endpush

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profile</h3>
                <p>Profile anda silahkan Diupdate.</p>
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
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Update Profile</h4>
                </div>
                <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" autocomplete="off" action="{{route('member.profile.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="form-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">Name</label>
                                <input type="text" id="first-name-vertical" class="form-control @error('name') is-invalid @enderror" value="{{Auth::user()->name }}" name="name" placeholder="First Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="email-id-vertical">Email</label>
                            <input type="email" id="email-id-vertical" class="form-control" name="email" value="{{Auth::user()->email}}" placeholder="Email" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <div class="form-group">
                                    <select class="choices form-select @error('province') is-invalid @enderror" id="provinsi" name="province">
                                        <option value="">--Pilih--</option>
                                        @foreach($provinces as $prov)
                                        <option value="{{ $prov->id }}" {{ $user->province == $prov->id ? 'selected' : '
                                        ' }}>{{ $prov->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('province')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <div class="form-group">
                                    <select class="form-select @error('district') is-invalid @enderror" id="district" name="district">
                                        @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $district->id == $user->district ? 'selected' : '' }}>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <div class="form-group">
                                    <select class="form-select @error('sub_district') is-invalid @enderror" id="sub_district" name="sub_district">
                                        @foreach($subDistricts as $sub)
                                        <option value="{{ $sub->id }}" {{ $sub->id == $user->sub_district ? 'selected' : '' }}>{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('sub_district')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Lembaga/Institusi</label>
                                <input type="text" class="form-control @error('institution') is-invalid @enderror" value="{{Auth::user()->institution}}" name="institution">
                                @error('institution')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>No Handphone</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" value="{{Auth::user()->phone}}" name="phone">

                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
</div>
@endsection

@push('script')
        <!-- Include Choices JavaScript -->
        <script src="/vendor/choices.js/choices.min.js"></script>
        <script>

        const provinsi = document.querySelector("#provinsi");
        const districts = document.querySelector("#district")
        const sub_district = document.querySelector("#sub_district");
        const choicesDistrict = new Choices(districts);
        const choicesSubDistrict = new Choices(sub_district);
        // console.log(provinsi)

        provinsi.addEventListener('change', function(){
            fetch(`/api/region/districts/${this.value}`)
            .then(res => res.json())
            .then(data => {
                choicesSubDistrict.clearStore();
                choicesDistrict.clearStore();
                choicesDistrict.setChoices(data.map(district => {
                    return {
                       label: district.name,
                       value: district.id
                    }
                }));
            })
        })

        districts.addEventListener('change', function(){
            fetch(`/api/region/sub-districts/${this.value}`)
            .then(res => res.json())
            .then(data => {
                choicesSubDistrict.clearStore();
                choicesSubDistrict.setChoices(data.map(subdistrict => {
                    return {
                       label: subdistrict.name,
                       value: subdistrict.id
                    }
                }));


            })
        })


        </script>
@endpush
