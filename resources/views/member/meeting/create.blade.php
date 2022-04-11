@extends('layouts.member.app')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Jadwalkan Meeting</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('member.meetings.store') }}" method="post" class="form form-horizontal">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="topic">Topik</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" name="topic" id="topic" class="form-control @error('topic') is-invalid @enderror" value="{{ old('topic') }}" autofocus>
                                @error('topic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="date">Tanggal/Waktu</label>
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="time" name="time" id="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time') }}">
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="timezone">Zona Waktu</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" name="timezone" id="timezone" class="form-control" value="(GMT+7:00)Jakarta" readonly>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">User Terdaftar</label>
                            </div>
                            <div class="col-md-7 form-group d-flex justify-content-between">
                                <div class="div">
                                    <input type="radio" name="user_authentication" id="no_auth" value="false" checked>
                                    <label for="no_auth">Tidak Diperlukan</label>
                                </div>
                                <div>
                                    <input type="radio" name="user_authentication" id="with_auth" value="true">
                                    <label for="with_auth">Diperlukan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Keamanan</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="passcode" id="passcode" class="form-control @error('passcode') is-invalid @enderror" placeholder="Passcode">
                                    @error('passcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
