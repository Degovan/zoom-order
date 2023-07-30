<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoomAppRequest;
use App\Models\ZoomApp;
use App\Repository\Zoom\AppRepository;

class ZoomAppController extends Controller
{
    protected AppRepository $repo;

    public function __construct()
    {
        $this->repo = new AppRepository;
    }

    public function index()
    {
        return view('admin.zoomapp.index');
    }

    public function create()
    {
        return view('admin.zoomapp.create');
    }

    public function store(ZoomAppRequest $request)
    {
        $this->repo->store($request->only([
            'name', 'client_id', 'client_secret'
        ]));

        return back()->with('alert_s', 'Berhasil menambahkan app');
    }

    public function edit(ZoomApp $app)
    {
        return view('admin.zoomapp.edit', [
            'zoomApp' => $app
        ]);
    }

    public function update(ZoomAppRequest $request, ZoomApp $app)
    {
        $this->repo->update($app, $request->only([
            'name', 'client_id', 'client_secret'
        ]));

        return back()->with('alert_s', 'Berhasil mengupdate app');
    }

    public function destroy(ZoomApp $app)
    {
        $app->delete();
        return back()->with('alert_s', 'Berhasil menghapus app');
    }

    public function datatables()
    {
        return datatables(ZoomApp::query())
            ->addIndexColumn()
            ->addColumn('detail_url', fn($app) => route('admin.zoom.app.show', $app->id))
            ->makeHidden(['client_secret'])
            ->toJson();
    }
}
