@extends('layouts.admin.app')

@section('content')
<div class="row py-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.zoom.accounts.update', $account) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fas fa-fw fa-envelope"></i>
                            </div>
                            <input type="email" id="email" class="form-control" value="{{ $account->email }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="host-key">host-key</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fas fa-fw fa-key"></i>
                            </div>
                            <input type="text" id="host-key" class="form-control" value="{{ $account->host_key }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="capacity">Kapasitas</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fas fa-fw fa-users"></i>
                            </div>
                            <input type="number" id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ $account->capacity }}" name="capacity" autofocus>
                            <div class="input-group-text">
                                peserta
                            </div>
                        </div>
                        @error('capacity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-1 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-fw fa-save"></i> simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
