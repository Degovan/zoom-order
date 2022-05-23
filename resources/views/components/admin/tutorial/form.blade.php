<form action="{{ $route }}" method="post">
    @csrf
    @if ($method != 'store')
        @method($method)
    @endif
    <div class="mb-4 pb-4 text-end">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan
        </button>
    </div>
    <div class="mb-4 row">
        <div class="col-md-6">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $tutorial->title ?? '' }}" autofocus>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            @php
                $icon = old('icon') ?? $tutorial->icon ?? 'package';
            @endphp
            <label for="icon">Ikon (<small class="text-info"><a href="https://feathericons.com/" target="_blank">daftar ikon</a></small>)</label>
            <div class="input-group">
                <span class="input-group-text" id="icon-prev">
                    <i data-feather="{{ $icon }}" width="20"></i>
                </span>
                <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ $icon }}">

                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="mb-4">
        <label for="content-editor">Konten</label>
        <textarea name="content" id="content-editor" class="form-control">{!! old('content') ?? $tutorial->content ?? '' !!}</textarea>
        @error('content')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</form>

@push('style')
<style>
.ck-editor__editable {
    min-height: 250px;
}
</style>
@endpush

@push('script')
<script src="/vendor/ckeditor/ckeditor.js"></script>
<script src="/vendor/voler/js/feather-icons/feather.min.js"></script>
<script>
    const editor = document.querySelector('#content-editor');
    const icon = document.getElementById('icon');
    const iconPrev = document.getElementById('icon-prev');

    ClassicEditor.create(editor, {
        height: 20,
        toolbar: ['undo', 'redo', '|', 'heading', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList']
    });

    icon.addEventListener('keyup', () =>  {
        const svg = document.querySelector('.feather');
        if(svg) svg.remove();

        iconPrev.innerHTML = `<i data-feather="${icon.value}" width="20"></i>`;
        feather.replace();
    });

    feather.replace();
</script>
@endpush
