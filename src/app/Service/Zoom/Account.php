<?php

namespace App\Service\Zoom;

use App\Factory\ZoomAuthFactory;
use App\Models\ZoomAccount;
use App\Repository\ZoomAccessTokenRepository;

class Account
{
    public static function verify(ZoomAccount $account)
    {
        $token = (new ZoomAccessTokenRepository)->get($account);
        static::refreshTokenIfExpired($account, $token);
    }

    public static function exist(string $email)
    {
        return !is_null(ZoomAccount::where('email', $email)->first());
    }

    public static function syncHostkey(ZoomAccount $account): ZoomAccount
    {
        $token = (new ZoomAccessTokenRepository)->get($account);

        if(($account->last_synced + 7200) < time()) {
            $user = (new ZoomAuthFactory($account->zoomApp))->getAccount($token);
            $account->update([
                'host_key' => $user['host_key'],
                'last_synced' => date('Y-m-d H:i:s')
            ]);
        }

        return $account;
    }

    private static function refreshTokenIfExpired(ZoomAccount $account, object $token)
    {
        if(($token->expires_in - time()) < 900) {
            $token = (new ZoomAuthFactory($account->zoomApp))->refreshAccessToken($token);
            (new ZoomAccessTokenRepository)->store($account->email, $token);
        }
    }
}
