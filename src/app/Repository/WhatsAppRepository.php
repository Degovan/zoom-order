<?php

namespace App\Repository;

class WhatsAppRepository
{
    public static function getApikey()
    {
        return option()->get('whatsapp.key');
    }

    public static function getDeviceID()
    {
        return option()->get('whatsapp.device');
    }

    public static function setApikey(string $apikey): void
    {
        option()->save('whatsapp.key', $apikey);
    }

    public static function setDeviceID(string $id): void
    {
        option()->save('whatsapp.device', $id);
    }

    public static function reset()
    {
        option()->save('whatsapp.key', '');
        option()->save('whatsapp.device', '');
    }
}
