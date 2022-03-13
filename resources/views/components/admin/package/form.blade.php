<div class="row pt-4">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-fw fa-hand-holding-usd"></i> Paket</h5>
            </div>
            <div class="card-body">
                @csrf
                @isset($method)
                    @method($method)
                @endisset
                <div class="mb-4">
                    <label for="title">Tagline</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $package->title ?? old('title') }}" autofocus>

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="summary">Ringkasan</label>
                    <input type="text" name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror" value="{{ $package->summary ?? old('summary') }}">

                    @error('summary')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2 mb-1">
                    @error('items.*')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4" id="items-area">
                    <label for="items">Keterangan</label>
                    @isset($package)
                    @foreach ($package->items as $item)
                    <div class="input-group mb-2">
                        <input type="text" name="items[]" class="form-control items-input" value="{{ $item }}">
                        <button type="button" class="btn btn-sm btn-danger btn-del-item">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-success btn-add-item"><i class="fas fa-plus"></i></button>
                    </div>
                    @endforeach
                    @else
                    <div class="input-group mb-2">
                        <input type="text" name="items[]" class="form-control items-input">
                        <button type="button" class="btn btn-sm btn-success btn-add-item"><i class="fas fa-plus"></i></button>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5>Harga</h5>
            </div>
            <div class="card-body">
                @error('pricings.*')
                <div class="alert alert-danger">
                    <ul>
                        <li><small>Harga harus diisi minimal satu daftar</small></li>
                        <li><small>Format pengisian harus benar (Semua berupa angka)</small></li>
                    </ul>
                </div>
                @enderror
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="10%">Peserta Maks</th>
                                <th width="30%">Harga (Rp)</th>
                                <th width="30%">Diskon</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pricing-area">
                            @isset($pricings)
                                @foreach($pricings as $pricing)
                                <tr class="pricing-item">
                                    <td>
                                        <input type="number" name="pricings[{{ $loop->index }}][max_audience]" class="form-control max-audience" value="{{ $pricing->max_audience }}">
                                    </td>
                                    <td>
                                        <input type="number" name="pricings[{{ $loop->index }}][cost]" class="form-control" value="{{ $pricing->cost }}">
                                    </td>
                                    <td>
                                        <input type="number" name="pricings[{{ $loop->index }}][discount]" class="form-control" value="{{ $pricing->discount }}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger del-pricing" @if($loop->first) disabled @endif>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="pricing-item">
                                    <td>
                                        <input type="number" name="pricings[0][max_audience]" class="form-control max-audience">
                                    </td>
                                    <td>
                                        <input type="number" name="pricings[0][cost]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" name="pricings[0][discount]" class="form-control">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endisset
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" id="add-pricing" class="btn btn-sm btn-success text-white me-1">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row pt-4 pb-4 justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
$('#items-area').on('click', '.btn-add-item', function(e) {
    $('#items-area').append(`
    <div class="input-group mb-2">
        <input type="text" name="items[]" class="form-control items-input">
        <button type="button" class="btn btn-sm btn-danger btn-del-item">
            <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-sm btn-success btn-add-item">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    `);
});

$('#items-area').on('click', '.btn-del-item', function(e) {
    let targeted = e.target;

    while (!(targeted.classList.contains('input-group'))) {
        targeted = targeted.parentElement;
    }

    targeted.remove();
});

// Pricing Management
$('#add-pricing').click(function() {
    const maxIndex = $('.max-audience').last();
    const index = parseInt(maxIndex.attr('name').match(/(?<=\[).+?(?=\])/g)[0]) + 1;

    $('#pricing-area').append(`
    <tr class="pricing-item">
        <td>
            <input type="number" name="pricings[${index}][max_audience]" class="form-control">
        </td>
        <td>
            <input type="number" name="pricings[${index}][cost]" class="form-control">
        </td>
        <td>
            <input type="number" name="pricings[${index}][audience]" class="form-control">
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-danger del-pricing">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
    `);
});

$('#pricing-area').on('click', '.del-pricing', function(e) {
    $(this).parents('.pricing-item').remove();
});

</script>
@endpush
