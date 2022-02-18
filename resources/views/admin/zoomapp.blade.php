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
                <div class="mb-3">
                    <label for="appid">App ID</label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <input type="text" name="appid" id="appid" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="appsecret">App Secret</label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fas fa-key"></i>
                        </div>
                        <input type="password" name="appsecret" id="appsecret" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="redirect">Redirect URL</label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fas fa-link"></i>
                        </div>
                        <input type="text" name="redirect" id="redirect" class="form-control" value="{{ config('app.url') }}/zoom/add" readonly>
                    </div>
                </div>
                
                <div class="mb-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
