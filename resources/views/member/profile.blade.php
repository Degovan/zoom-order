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
                                    <select class="choices form-select" name="province" onchange="getVal(this)">
                                        @foreach($provinces as $prov)
                                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <div class="form-group">
                                    <select class="choices form-select" id="district">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <div class="form-group">
                                    <select class="choices form-select" id="sub_district">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Lembaga/Institusi</label>
                                <input type="text" class="form-control @error('institution') is-invalid @enderror" value="{{Auth::user()->institution}}">
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
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" value="{{Auth::user()->phone}}">

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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    function getVal(sel) {
        province_id = sel.value
        console.log(province_id)
    }
</script>
@endpush
