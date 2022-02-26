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
            (new ZoomService)->linkAccount($request->code);

            return redirect()
                    ->route('admin.zoom.account.index')
                    ->with('flash_s', 'Sukses menghubungkan akun');
        } catch(ZoomServiceException $e) {
            return redirect()
                    ->route('admin.zoom.account.index')
                    ->with('flash_e', "Error: {$e->getMessage()}");
        }
    }
}
