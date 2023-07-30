<form action="{{ route('admin.pricings.store') }}" method="post">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <div class="mb-4">
        <label for="title">Tagline</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $pricing->title ?? old('title') }}" autofocus>

        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="summary">Ringkasan</label>
        <input type="text" name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror" value="{{ $pricing->summary ?? old('summary') }}">

        @error('summary')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="cost">Harga (Rp)</label>
        <input type="number" name="cost" id="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ $pricing->cost ?? old('cost', 0) }}">

        @error('cost')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="discount">Diskon (Rp)</label>
        <input type="number" name="discount" id="discount" class="form-control @error('dicount') is-invalid @enderror" value="{{ $pricing->discount ?? old('discount', 0) }}">

        @error('discount')
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
        @isset($pricing)
        @foreach ($pricing->items as $item)
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
    <div class="mb-2 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan
        </button>
    </div>
</form>

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

</script>
@endpush
