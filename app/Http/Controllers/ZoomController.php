<?php

namespace App\Http\Controllers;

use App\Exceptions\ZoomServiceException;
use App\Service\ZoomService;
use Illuminate\Http\Request;

class ZoomController extends Controller
{   
    public function linkAccount(Request $request)
    {
        return view('zoom-account', [
            'code' => $request->code
        ]);
    }
}
