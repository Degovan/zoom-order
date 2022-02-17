<?php

namespace App\Http\Controllers\Admin;

use App\Models\ZoomCredential;
use App\Http\Requests\ZoomCredentials\{StoreZoomCredentialRequest, UpdateZoomCredentialRequest};
use App\Http\Controllers\Controller;

class ZoomCredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ZoomCredential::orderBy('created_at', 'desc')->get();
        return view('admin.zoom-credentials.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.zoom-credentials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZoomCredentialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZoomCredentialRequest $request)
    {

        $attr = $request->all();
        ZoomCredential::create($attr);

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZoomCredential  $zoomCredential
     * @return \Illuminate\Http\Response
     */
    public function show(ZoomCredential $zoomCredential)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZoomCredential  $zoomCredential
     * @return \Illuminate\Http\Response
     */
    public function edit(ZoomCredential $zoomCredential)
    {
        return view('admin.zoom-credentials.edit', compact('zoomCredential'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZoomCredentialRequest  $request
     * @param  \App\Models\ZoomCredential  $zoomCredential
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZoomCredentialRequest $request, ZoomCredential $zoomCredential)
    {
        $attr = $request->all();
        $zoomCredential->update($attr);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZoomCredential  $zoomCredential
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZoomCredential $zoomCredential)
    {
        $zoomCredential->delete();
        return back();
    }
}
