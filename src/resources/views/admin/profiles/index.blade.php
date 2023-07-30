
@extends('layouts.admin.app')

@section('content')
    <div class="row mt-4">
        <div class="col-12 col-xl-8">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">General information</h2>
                <form action=" {{route('admin.profile.update')}} " autocomplete="off" method="POST">
                    @csrf
                    @method('PATCH')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="first_name">Name</label>
                            <input class="form-control
                            @error('name')
                                is-invalid
                            @enderror" value="{{Auth::user()->name}}" id="n" type="text" name="name" placeholder="Enter your first name" >
                        </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="last_name">Email</label>
                            <input class="form-control" value="{{Auth::user()->email}}" readonly id="last_name" type="text" placeholder="Also your last name" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow border-0 text-center p-0">
                        <div class="profile-cover rounded-top" data-background="../assets/img/profile-cover.jpg" style="background: url(&quot;../assets/img/profile-cover.jpg&quot;);"></div>
                        <div class="card-body pb-5"><img src="../assets/img/team/profile-picture-1.jpg" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait"><h4 class="h3">{{ Auth::user()->name }}</h4><h5 class="fw-normal">{{ Auth::user()->email }}</h5><p class="text-gray mb-4">New York, USA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
