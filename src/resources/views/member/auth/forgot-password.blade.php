@extends('layouts.member.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card py-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <h3>Reset Password</h3>
                        <p>Masukan email anda untuk mendapatkan tautan reset password.</p>
                    </div>
                    <form action="{{ route('member.password.reset')}}" method="POST">
                        @csrf
                        @if(session()->has('status'))
                        <div class="alert alert-success">
                            <p>{{ session()->get('status') }}</p>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
