<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZoomAccount;
use Illuminate\Http\Request;

class ZoomAccountController extends Controller
{
    public function index()
    {
        return view('admin.zoomaccount');
    }

    public function destroy($id)
    {
        ZoomAccount::destroy($id);

        return redirect()->back()->with('flash_s', 'Berhasil menghapus akun');
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
