<?php

namespace App\Http\Controllers\Member;

use App\Exceptions\MeetingException;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Member\MeetingMiddleware;
use App\Http\Requests\Member\MeetingRequest;
use App\Models\{Order, ZoomMeeting};
use App\Service\MeetingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware(MeetingMiddleware::class)
            ->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.meeting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('member.meeting.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingRequest $request, Order $order)
    {
        if($request->passcode) {
            $request->validate(['passcode' => 'required|alpha_dash|max:10']);
        }

        try {
            $meeting = MeetingService::create($order->invoice, $request);
            $order->decrement('remaining');

            return redirect()->route('member.meetings.show', $meeting);
        } catch(MeetingException $exception) {
            return back()->withInput()->with('alert_e', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ZoomMeeting $meeting, Request $request)
    {
        $user = request()->user();
        if($meeting->user_id != $user->id) return back();

        return view('member.meeting.show', compact('meeting', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meeting = ZoomMeeting::findOrFail($id);

        if($meeting->status != 'waiting') {
            return redirect()->back()
                    ->with('alert_e', 'Tidak dapat membatalkan meeting yang telah dimulai');
        }

        try {
            MeetingService::cancel($meeting);
        } catch(MeetingException $exception)
        {
            return back()->with('alert_e', $exception->getMessage());
        }

        $meeting->order->increment('remaining', 1);
        $meeting->delete();

        return redirect()->route('member.meetings.index')
                ->with('alert_s', 'Berhasil membatalkan meeting');
    }

    public function datatables()
    {
        return datatables(ZoomMeeting::whereBelongsTo(Auth::user()))
                ->addIndexColumn()
                ->editColumn('start', fn($d) => $d->start->format('d/m/Y H:i T'))
                ->editColumn('end', fn($d) => $d->end->format('d/m/Y H:i T'))
                ->toJson();
    }

    public function start($id)
    {
        $meeting = ZoomMeeting::findOrFail($id);

        if(!Carbon::now()->lt($meeting->start)) {
            $meeting->update(['status' => 'active']);
            return redirect()->to($meeting->start_url);
        }

        return back()->with('alert_e', 'Anda bisa memulai meeting sesuai waktu yang telah dijadwalkan');
    }
}
