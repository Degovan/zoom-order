<?php

namespace App\Service;

use App\Contracts\Messageable;
use App\Repository\WhatsAppRepository;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    private string $apikey, $deviceID;
    private string $endpoint = 'https://app.alatwa.com/api';
    private PendingRequest $client;

    public function __construct()
    {
        $this->apikey = WhatsAppRepository::getApikey() ?? '';
        $this->deviceID = WhatsAppRepository::getDeviceID() ?? '';

        $this->client = Http::withHeaders([
            'Authorization' => $this->apikey,
        ]);
    }

    public function isValidConnection(): bool
    {
        $res = $this->client->post($this->endpoint . '/device/list');
        if(!$res->ok()) return false;

        $existDevice = array_filter($res->object()->devices, function($device) {
            return $device->device_id == $this->deviceID;
        });

        return empty($existDevice) ? false : true;
    }

    public function getConnection()
    {
        if(!$this->isValidConnection()) {
            WhatsAppRepository::reset();
            return null;
        }

        $devices = $this->client->post($this->endpoint . '/device/list')->object()->devices;
        return array_filter($devices, fn($dvc) => $dvc->device_id == $this->deviceID)[0];
    }

    public function sendMessage(Messageable $message, string $phone)
    {
        $res = $this->client->post($this->endpoint . '/send/message/text', [
            'device' => $this->deviceID,
            'type' => 'text',
            'phone' => whatsappNumber($phone),
            'message' => $message->toText(),
        ]);

        return $res->ok();
    }
}
