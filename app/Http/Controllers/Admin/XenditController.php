<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\XenditRequest;
use App\Repository\XenditSecretRepository;
use App\Service\XenditService;

class XenditController extends Controller
{
    protected XenditService $service;

    public function __construct()
    {
        $this->service = new XenditService;
    }

    public function index()
    {   
        return view('admin.xendit.index', [
            'secret' => XenditSecretRepository::get(),
            'balance' => $this->service->balance()
        ]);
    }

    public function store(XenditRequest $request)
    {
        XenditSecretRepository::put($request->secret);
        return back()->with('alert_s', 'Berhasil menyimpan data');
    }
}
