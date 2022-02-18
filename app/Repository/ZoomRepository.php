<?php

namespace App\Repository;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

class ZoomRepository implements ZoomRepositoryInterface
{
    public const CONFIGFILE = 'app_zoom.json';
    
    private FilesystemAdapter $storage;

    public function __construct()
    {
        $this->storage = Storage::disk('local');
        $this->createIfEmpty();
    }


    public function get(): object
    {
        $content = $this->storage->get(self::CONFIGFILE);
        return json_decode($content);
    }

    public function store(array $data): void
    {
        $oldConfig = $this->get();
        $newConfig = [
            'app_id' => $data['app_id'] ?? $oldConfig->app_id,
            'app_secret' => $data['app_secret'] ?? $oldConfig->app_secret,
            'redirect_url' => route('zoom.app')
        ];

        $this->storage->put(self::CONFIGFILE, json_encode($newConfig));
    }

    private function createIfEmpty()
    {
        $blueprint = [
            'app_id' => '',
            'app_secret' => '',
            'redirect_url' => route('zoom.app')
        ];

        if(!$this->storage->exists(self::CONFIGFILE)) {
            $this->storage->put(self::CONFIGFILE, json_encode($blueprint));
        }
    }
}
