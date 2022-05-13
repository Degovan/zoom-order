<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZoomMeeting;
use App\Service\MeetingService;

class MeetingController extends Controller
{
    public function index()
    {
        return view('admin.meeting.index');
    }

    public function stop($id)
    {
        $meeting = ZoomMeeting::findOrFail($id);
        $stopped = MeetingService::stop($meeting);

        if($stopped) return back()->with('alert_s', 'Berhasil memberhentikan meeting');
        return back()->with('alert_e', 'Gagal memberhentikan meeting');
    }

    public function getOngoing()
    {
        $data = ZoomMeeting::query()->where('status', 'waiting');

        return datatables($data)
                ->addIndexColumn()
                ->editColumn('start', fn($data) => $data->start->format('d/m/Y H:i'))
                ->editColumn('end', fn($data) => $data->end->format('d/m/Y H:i'))
                ->toJson();
    }

    public function getRunning()
    {
        $data = ZoomMeeting::query()->where('status', 'active');

        return datatables($data)
                ->addIndexColumn()
                ->editColumn('start', fn($data) => $data->start->format('d/m/Y H:i'))
                ->editColumn('end', fn($data) => $data->end->format('d/m/Y H:i'))
                ->toJson();
    }

    public function getFinish()
    {
        $data = ZoomMeeting::query()->where('status', 'finish');

        return datatables($data)
                ->addIndexColumn()
                ->editColumn('start', fn($data) => $data->start->format('d/m/Y H:i'))
                ->editColumn('end', fn($data) => $data->end->format('d/m/Y H:i'))
                ->toJson();
    }
}
