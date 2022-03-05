<?php

namespace App\Http\Controllers\Admin;

use App\Factory\ZoomAuthFactory;
use App\Http\Controllers\Controller;
use App\Models\ZoomAccount;

class ZoomAccountController extends Controller
{
    public function index()
    {
        return view('admin.zoomaccount', [
            'auth_url' => (new ZoomAuthFactory)->generateAuthUrl()
        ]);
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
            ->addColumn('delUrl', fn($acc) => route('admin.zoom.account.destroy', $acc->id))
            ->make(true);
    }
}
