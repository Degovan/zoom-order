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
            'client_id' => $data['client_id'] ?? $oldConfig->client_id,
            'client_secret' => $data['client_secret'] ?? $oldConfig->client_secret,
            'redirect_url' => route('zoom.app')
        ];

        $this->storage->put(self::CONFIGFILE, json_encode($newConfig));
    }

    private function createIfEmpty()
    {
        $blueprint = [
            'client_id' => '',
            'client_secret' => '',
            'redirect_url' => route('zoom.app')
        ];

        if(!$this->storage->exists(self::CONFIGFILE)) {
            $this->storage->put(self::CONFIGFILE, json_encode($blueprint));
        }
    }
}
