<?php

namespace App\Repository\Zoom;

use App\Models\ZoomApp;

class AppRepository
{
    public string $redirect_url;

    public function __construct()
    {
        $this->redirect_url = route('zoom.add');
    }

    public static function getAvailable()
    {
        return ZoomApp::doesntHave('zoomAccount')->get();
    }

    public function store(array $data): ZoomApp
    {
        $data = array_merge($data, ['redirect_url' => $this->redirect_url]);
        return ZoomApp::create($data);
    }

    public function update(ZoomApp $app, array $data): ZoomApp
    {
        $data = array_merge($data, ['redirect_url' => $this->redirect_url]);
        $app->update($data);

        return $app;
    }
}
