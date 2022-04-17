@extends('layouts.member.app')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Meeting</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="topic">Topik</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="topic" class="form-control" value="{{ $meeting->topic }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 pt-2">
                            <label for="date">Tanggal/Waktu</label>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control" value="{{ $meeting->start->format('d/m/Y') }}" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control" value="{{ $meeting->start->format('H:i T') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="passcode">Passcode</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{ $meeting->passcode }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    @if($meeting->status != 'finish')
                    <a href="{{ route('member.meetings.start', $meeting) }}" class="btn btn-success">
                        Gabung <i data-feather="play"></i>
                    </a>
                    @endif

                    @if($meeting->status == 'active')
                    <button class="btn btn-info" id="join-url" data-clipboard-text="{{ $meeting->join_url}}">
                        Salin Link <i data-feather="copy"></i>
                    </button>
                    @endif

                    @if($meeting->status == 'waiting')
                    <form action="{{ route('member.meetings.destroy', $meeting) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Batalkan <i data-feather="x-circle"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<script>
const clipboard = new ClipboardJS('#join-url');

console.log(clipboard);
</script>
@endpush
