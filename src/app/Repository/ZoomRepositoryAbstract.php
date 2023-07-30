<?php

namespace App\Repository;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

abstract class ZoomRepositoryAbstract
{
    public const CONFIGFILE = 'app_zoom.json';
    
    protected FilesystemAdapter $storage;

    public function __construct()
    {
        $this->storage = Storage::disk('local');
    }
}
