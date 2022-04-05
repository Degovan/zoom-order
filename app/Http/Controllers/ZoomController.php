<?php

namespace App\Http\Controllers;

use App\Exceptions\ZoomServiceException;
use App\Service\ZoomService;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function linkAccount(Request $request)
    {
        try {
            $account = (new ZoomService)->linkAccount($request->code);

            return redirect()
                    ->route('admin.zoom.accounts.edit', $account)
                    ->with('alert_s', 'Sukses menghubungkan akun');
        } catch(ZoomServiceException $e) {
            return redirect()
                    ->route('admin.zoom.accounts.index')
                    ->with('alert_e', "Error: {$e->getMessage()}");
        }
    }
}
