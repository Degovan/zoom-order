<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WhatsAppRequest;
use App\Repository\WhatsAppRepository;
use App\Service\WhatsAppService;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function index()
    {
        return view('admin.whatsapp',[
            'apikey' => WhatsAppRepository::getApikey(),
            'deviceid' => WhatsAppRepository::getDeviceID(),
            'connection' => (new WhatsAppService)->getConnection(),
        ]);
    }

    public function store(WhatsAppRequest $request)
    {
        WhatsAppRepository::setApikey($request->apikey);
        WhatsAppRepository::setDeviceID($request->deviceid);

        $isValid = (new WhatsAppService)->isValidConnection();

        if(!$isValid) {
            WhatsAppRepository::reset();
            return back()->with('alert_e', 'Perangkat tidak dapat terhubung');
        }

        return back()->with('alert_s', 'Berhasil menghubungkan perangkat');
    }
}
