<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoomAppRequest;
use App\Repository\ZoomRepository;

class ZoomAppController extends Controller
{
    protected ZoomRepository $zoom;

    public function __construct()
    {
        $this->zoom = new ZoomRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.zoomapp', [
            'zoom' => $this->zoom->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoomAppRequest $request)
    {
        $this->zoom->store($request->all());

        return redirect()->back()->with('alert_s', 'Data berhasil disimpan');
    }
}
