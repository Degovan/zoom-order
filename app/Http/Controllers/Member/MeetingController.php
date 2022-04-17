<?php

namespace App\Http\Controllers\Member;

use App\Exceptions\MeetingException;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Member\MeetingMiddleware;
use App\Http\Requests\Member\MeetingRequest;
use App\Models\Order;
use App\Models\ZoomMeeting;
use App\Service\MeetingService;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware(MeetingMiddleware::class)
            ->except(['index', 'destroy']);
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
            dd(MeetingService::create($order->invoice, $request));
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
    public function show($id)
    {
        //
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
        //
    }

    public function datatables()
    {
        return datatables(ZoomMeeting::query())
                ->addIndexColumn()
                ->editColumn('start', fn($d) => $d->start->format('d/m/Y H:i T'))
                ->editColumn('end', fn($d) => $d->end->format('d/m/Y H:i T'))
                ->toJson();
    }
}
