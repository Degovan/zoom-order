<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoomAccountRequest;
use App\Models\ZoomAccount;
use App\Repository\Zoom\AccountRepository;
use App\Repository\Zoom\AppRepository;

class ZoomAccountController extends Controller
{
    protected AccountRepository $appRepo;

    public function __construct()
    {
        $this->accRepo = new AccountRepository;
    }

    public function index()
    {
        return view('admin.zoomaccount.index');
    }

    public function create()
    {
        $apps = AppRepository::getAvailable();
        return view('admin.zoomaccount.create', compact('apps'));
    }

    public function store(ZoomAccountRequest $request)
    {
        $this->accRepo->store($request->only([
            'zoom_app_id', 'capacity', 'email'
        ]));

        return back()->with('alert_s', 'Berhasil menambahkan akun');
    }

    public function destroy($id)
    {
        ZoomAccount::destroy($id);

        return redirect()->back()->with('alert_s', 'Berhasil menghapus akun');
    }

    public function datatables()
    {
        return datatables()
            ->of(ZoomAccount::query())
            ->addIndexColumn()
            ->editColumn('capacity', fn($acc) => "$acc->capacity peserta")
            ->addColumn('editUrl', fn($acc) => route('admin.zoom.accounts.edit', $acc))
            ->addColumn('delUrl', fn($acc) => route('admin.zoom.accounts.destroy', $acc))
            ->make(true);
    }
}
