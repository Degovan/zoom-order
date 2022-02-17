<div class="card-body">
    <div class="row mb-4">
        <div class="col-lg-6 col-sm-6">
            <div class="mb-4">
                <label for="">SDK key</label>
                <input type="text"
                        class="form-control
                        @error('sdk_key')
                        is-invalid
                        @enderror"
                        id="key"
                        name="sdk_key"
                        value="{{old('sdk_key')}}">

                    @error('sdk_key')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
            <div class="">
                <label for="">SDK secret</label>
                <input type="text" class="form-control @error('sdk_secret') is-invalid @enderror" id="secret" name="sdk_secret"
                value="{{old('sdk_secret')}}">

                @error('sdk_secret')
                        <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </div>
</div>
<div class="card-footer">
    <button class="btn btn-primary">{{$btn ?? 'Update'}}</button>
</div>
