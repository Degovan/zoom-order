@extends('layouts.member.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <h3>Member Area</h3>
                        <p>Masuk ke platform kami untuk melanjutkan.</p>
                    </div>
                    <form action="{{ route('member.login') }}" method="post">
                        @csrf

                        @if(session()->has('status'))
                        <div class="alert alert-success">
                            <p>{{ session()->get('status') }}</p>
                        </div>
                        @endif
                        
                        <div class="form-group position-relative has-icon-left">
                            <label for="username">Email</label>
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
                                <a href="{{ route('member.forgot')}}" class='float-end'>
                                    <small>Lupa sandi?</small>
                                </a>
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class='form-check clearfix my-4'>
                            <div class="checkbox float-start">
                                <input type="checkbox" id="checkbox1" class='form-check-input' name="remember" @checked(old('remember'))>
                                <label for="checkbox1">Ingat saya</label>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('member.register')}}">Tidak mempunyai akun?</a>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-primary float-end">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
