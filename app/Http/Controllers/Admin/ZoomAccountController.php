<?php

namespace App\Http\Controllers\Admin;

use App\Factory\ZoomAuthFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoomAccountRequest;
use App\Models\ZoomAccount;

class ZoomAccountController extends Controller
{
    public function index()
    {
        return view('admin.zoomaccount.index', [
            'auth_url' => (new ZoomAuthFactory)->generateAuthUrl()
        ]);
    }

    public function edit(ZoomAccount $account)
    {
        return view('admin.zoomaccount.edit', compact('account'));
    }

    public function update(ZoomAccount $account, ZoomAccountRequest $request)
    {
        $account->update($request->only('capacity'));

        return redirect()
                ->route('admin.zoom.accounts.index')
                ->with('alert_s', 'Detail akun telah diperbarui');
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
