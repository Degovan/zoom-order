@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">WhatsApp API</h1>
        <p class="mb-0">Berfungsi untuk mengirimkan pesan ke nomor WhatsApp.</p>
    </div>
    <div>
        <a href="https://alatwa.docs.apiary.io/" class="btn btn-outline-gray"><i class="far fa-question-circle me-1"></i> Dokumentasi</a>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.whatsapp.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="apikey">API Key</label>
                        <input type="text" name="apikey" id="apikey" class="form-control @error('apikey') is-invalid @enderror" value="{{ $apikey ?? '' }}" autocomplete="off" autofocus>
                        @error('apikey')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deviceid">Device ID</label>
                        <input type="text" name="deviceid" id="deviceid" class="form-control @error('deviceid') is-invalid @enderror" value="{{ $deviceid ?? '' }}" autocomplete="off" autofocus>
                        @error('deviceid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($connection)
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <i class="fas fa-fw fa-mobile-alt"></i> <span class="ms-3">{{ $connection->whatsapp_number }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-fw fa-signal"></i> <span class="ms-3">{{ $connection->connection }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-fw fa-vote-yea"></i> <span class="ms-3">{{ $connection->status }}</span>
                    </li>
                </ul>
            </div>
        </div>
        {{-- @php dd($connection) @endphp --}}
    </div>
    @endif
</div>
@endsection
