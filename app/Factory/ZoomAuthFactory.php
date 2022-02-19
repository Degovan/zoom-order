<?php

namespace App\Factory;

use App\Repository\ZoomRepository;

class ZoomAuthFactory implements ZoomAuthFactoryContract
{
    public const AUTHURL = 'https://zoom.us/oauth/authorize';

    public function __construct()
    {
        $this->zoomapp = (new ZoomRepository)->get();
    }

    public function generateAuthUrl(): string
    {
        $queries = [
            'response_type' => 'code',
            'client_id' => $this->zoomapp->client_id,
            'redirect_uri' => $this->zoomapp->redirect_url
        ];

        return self::AUTHURL . http_build_query($queries);
    }
}
