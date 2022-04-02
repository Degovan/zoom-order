@extends('layouts.member.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <h3>Member Area</h3>
                        <p>Silahkan masukkan akun anda untuk mendaftar.</p>
                    </div>
                    <form action="{{ route('member.register') }}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left">
                            <label for="username">Username</label>
                            <div class="position-relative">
                                <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus>
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <label for="email">Email</label>
                            <div class="position-relative">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autofocus>
                                <div class="form-control-icon">
                                    <i data-feather="mail"></i>
                                </div>
                            </div>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="password">Kata sandi</label>
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="clearfix">
                                <label for="password">Konfirmasi kata sandi</label>
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>

                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class='form-check clearfix my-4'>
                            <div class="float-end">
                                <a href="{{ route('member.login')}}">Sudah punya akun?</a>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-primary float-end">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
