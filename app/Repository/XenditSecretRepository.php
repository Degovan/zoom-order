<?php

namespace App\Repository;

use Illuminate\Support\Facades\Storage;

class XenditSecretRepository {
    private static $config = 'xendit_secret.txt';

    public static function get()
    {
        return Storage::disk('local')->get(static::$config);
    }

    public static function put(string $secret): void
    {
        Storage::disk('local')->put(static::$config, $secret);
    }
}
