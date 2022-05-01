<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZoomMeeting;
use Illuminate\Http\Request;
use DataTables;

class MeetingController extends Controller
{
    public function index()
    {
        return view('admin.meeting.index');
    }

    public function getOngoing(Request $request)
    {
        if ($request->ajax()) {
            $data = ZoomMeeting::where('status', 'waiting')
                                    ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function getRunning(Request $request)
    {
        if ($request->ajax()) {
            $data = ZoomMeeting::where('status', 'active')
                                    ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function getFinish(Request $request)
    {
        if ($request->ajax()) {
            $data = ZoomMeeting::where('status', 'finish')
                                    ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
    }
}
