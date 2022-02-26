<?php

namespace App\Factory;

use App\Models\ZoomAccount;

interface ZoomAuthFactoryContract
{
    public function generateAuthUrl(): string;

    /**
     * Generate Request Access Token
     * @param string $grantType | authorization_code, refresh_token
     * @param string $code | optional - if grantType is authorization_code
     */
    public function requestAccessToken(string $code): array;

    /**
     * Refresh Access Token
     * @param object $token
     * @return void
     */
    public function refreshAccessToken(object $token): array;

    /**
     * Get account information from OAuth
     */
    public function getAccount(object $token);
}
