@extends('layouts.member.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card py-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <h3>Reset Password</h3>
                        <p>Buat password baru anda.</p>
                    </div>
                    <form action="{{ route('member.reset') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->token }}">

                        <div class="form-group position-relative has-icon-left">
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $request->email }}" readonly>
                            <div class="form-control-icon">
                                <i data-feather="mail" width="20"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group pt-2">
                            <div class="divider divider-center">
                                <div class="divider-text">Buat Password</div>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left">
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password baru" autofocus>
                            <div class="form-control-icon">
                                <i data-feather="key" width="20"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi password">
                            <div class="form-control-icon">
                                <i data-feather="lock" width="20"></i>
                            </div>
                        </div>
                        
                        <div class="clearfix">
                            <button class="btn btn-primary float-end">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
