@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Zoom App</h1>
        <p class="mb-0">Detail informasi mengenai aplikasi zoom anda.</p>
    </div>
    <div>
        <a href="https://themesberg.com/docs/volt-bootstrap-5-dashboard/components/forms/" class="btn btn-outline-gray"><i class="far fa-question-circle me-1"></i> Dokumentasi</a>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.zoom-app.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="appid">Client ID</label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <input type="text" name="client_id" id="appid" class="form-control @error('client_id') is-invalid @enderror" value="{{ $zoom->client_id }}" autofocus>
                    </div>
                    @error('client_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="appsecret">Client Secret</label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fas fa-key"></i>
                        </div>
                        <input type="password" name="client_secret" id="appsecret" class="form-control @error('client_secret') is-invalid @enderror" value="{{ $zoom->client_secret }}">
                    </div>
                    @error('client_secret')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="redirect">Redirect URL</label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fas fa-link"></i>
                        </div>
                        <input type="text" name="redirect" id="redirect" class="form-control" value="{{ $zoom->redirect_url }}" readonly>
                    </div>
                </div>
                
                <div class="mb-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
