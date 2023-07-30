@csrf
<div class="mb-4">
    <label for="name">Nama</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $zoomApp->name ?? '' }}" autofocus>

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-4">
        <label for="client_id">Client ID</label>
        <input type="text" name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror" value="{{ old('client_id') ?? $zoomApp->client_id ?? '' }}">

        @error('client_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-4">
        <label for="client_secret">Client Secret</label>
        <input type="password" name="client_secret" id="client_secret" class="form-control @error('client_secret') is-invalid @enderror" value="{{ old('client_secret') ?? $zoomApp->client_secret ?? '' }}">

        @error('client_secret')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mb-4">
    <label for="redirect_url">Redirect URL</label>
    <input type="text" id="redirect_url" class="form-control" value="{{ route('zoom.add') }}" readonly>
</div>
<div class="mb-2 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Simpan
    </button>
</div>
