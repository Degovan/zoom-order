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
        <div class="col-md-10 col-lg-6">
            <div class="card mt-2">
                <div class="card-header">
                    <div class="text-primary border border-primary rounded p-1 p-md-2 p-lg-3 d-flex align-items-center">
                        <span class="icon me-2 mx-auto">
                            <i data-feather="alert-triangle" style="width:40px; height: 40px;"></i>
                        </span>
                        <p class="m-0">Host harus diclaim agar <strong>room</strong> bisa berjalan <strong>lebih dari 40 menit</strong> & fitur PRO lainnya dapat digunakan. Claim host dapat dilakukan dengan menginputkan <strong>host key</strong> dibawah</p>
                    </div>
                </div>
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
                    <div class="form-group row position-relative has-icon-right">
                        <div class="col-md-4">
                            <label for="host-key">Host Key</label>
                        </div>
                        <div class="col-md-8 has-icon-right">
                            <input type="text" id="host-key" class="form-control" value="{{ $meeting->host_key() }}" readonly>
                            <div class="form-control-icon me-2" id="btn-copy-hostkey" title="copy" data-clipboard-target="#host-key">
                                <i data-feather="copy"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    @if($meeting->status != 'finish')
                    <a href="{{ route('member.meetings.start', $meeting) }}" class="btn btn-success">
                        Gabung <i data-feather="play"></i>
                    </a>
                    @endif

                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#meeting-inv">
                        Salin Link <i data-feather="copy"></i>
                    </button>

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

<div class="modal fade text-left modal-borderless" id="meeting-inv" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invitation Link</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="inv-text" class="form-control" rows="12" readonly>{{ $user->name }} mengundang anda pada zoom meeting.

Topik: {{ $meeting->topic }}
Waktu: {{ $meeting->start->format('d M Y, H:i T') }}

Join zoom meeting:
{{ $meeting->join_url }}

Meeting ID: {{ $meeting->zoom_meeting_id }}
Passcode: {{ $meeting->passcode }}</textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger close" data-bs-dismiss="modal">
                    <i data-feather="x"></i> Tutup
                </button>
                <button class="btn btn-sm btn-primary" id="btn-copy" data-clipboard-target="#inv-text">
                    <i data-feather="copy"></i> Salin
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<script>
new ClipboardJS('#btn-copy');
new ClipboardJS('#btn-copy-hostkey');
</script>
@endpush
