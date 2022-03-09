@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Xendit Key</h1>
        <p class="mb-0">Xendit secret key berfungsi sebagai autentikasi.</p>
    </div>
    <div>
        <a href="https://developers.xendit.co/api-reference/#authentication" class="btn btn-outline-gray"><i class="far fa-question-circle me-1"></i> Dokumentasi</a>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.xendit.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="secret">Secret key</label>
                    <input type="text" name="secret" id="secret" class="form-control @error('secret') is-invalid @enderror" value="{{ $secret ?? '' }}" autofocus>
                    @error('secret')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
