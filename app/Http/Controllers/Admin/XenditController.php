<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\XenditRequest;
use App\Repository\XenditSecretRepository;

class XenditController extends Controller
{
    public function index()
    {
        $secret = XenditSecretRepository::get();

        return view('admin.xendit.index', compact('secret'));
    }

    public function store(XenditRequest $request)
    {
        XenditSecretRepository::put($request->secret);
        return back()->with('alert_s', 'Berhasil menyimpan data');
    }
}
