@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between w-100 flex-wrap mt-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Tambah Akun Zoom</h1>
        <p class="mb-0">Menambahkan akun zoom ke aplikasi</p>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.zoom.accounts.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="zoom_app_id">Aplikasi Zoom</label>
                                <select name="zoom_app_id" id="zoom_app_id" class="form-control @error('zoom_app_id') is-invalid @enderror">
                                    @forelse ($apps as $app)
                                    <option value="{{ $app->id }}">{{ $app->name }}</option>
                                    @empty
                                    <option value="">--Buat App--</option>
                                    @endforelse
                                </select>

                                @error('zoom_app_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="capacity">Kapasitas Peserta</label>
                                <input type="number" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror">

                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="host_key">Host Key</label>
                                <input type="text" name="host_key" id="host_key" class="form-control @error('host_key') is-invalid @enderror">

                                @error('host_key')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
