<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ZoomServiceException;
use App\Factory\ZoomAuthFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoomAccountRequest;
use App\Models\ZoomAccount;
use App\Models\ZoomApp;
use App\Repository\Zoom\AccountRepository;
use App\Repository\Zoom\AppRepository;
use App\Service\ZoomService;
use Illuminate\Http\Request;

class ZoomAccountController extends Controller
{
    protected AccountRepository $accRepo;

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

    public function edit(ZoomAccount $account)
    {
        return view('admin.zoomaccount.edit', compact('account'));
    }

    public function update(ZoomAccountRequest $request, ZoomAccount $account)
    {
        $this->accRepo->update($account, $request->only('capacity'));
        return back()->with('alert_s', 'Berhasil mengupdate akun');
    }

    public function connect(ZoomAccount $account)
    {
        $url = (new ZoomAuthFactory($account->zoomApp))->generateAuthUrl();
        return redirect($url);
    }

    public function authenticate(Request $request)
    {
        if($request->email) {
            $account = ZoomAccount::where('email', $request->email)->first();

            if($account) {
                try {
                    (new ZoomService($account))->linkAccount($request->code);
                    return back()->with('alert_s', 'Sukses menghubungkan akun');
                } catch(ZoomServiceException $e) {
                    return back()->with('alert_e', $e->getMessage());
                }
            }
        }

        return back()->with('alert_e', 'Akun zoom tidak ditemukan');
    }

    public function destroy(ZoomAccount $account)
    {
        $this->accRepo->destroy($account);
        return redirect()->back()->with('alert_s', 'Berhasil menghapus akun');
    }

    public function datatables()
    {
        return datatables()
            ->of(ZoomAccount::query())
            ->addIndexColumn()
            ->editColumn('capacity', fn($acc) => "$acc->capacity peserta")
            ->addColumn('connectUrl', fn($acc) => route('admin.zoom.accounts.connect', $acc))
            ->addColumn('editUrl', fn($acc) => route('admin.zoom.accounts.edit', $acc))
            ->addColumn('delUrl', fn($acc) => route('admin.zoom.accounts.destroy', $acc))
            ->make(true);
    }
}
