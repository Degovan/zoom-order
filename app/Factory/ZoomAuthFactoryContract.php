<?php

namespace App\Factory;

interface ZoomAuthFactoryContract
{
    public function generateAuthUrl(): string;

    /**
     * Generate Request Access Token
     * @param string $grantType | authorization_code, refresh_token
     * @param string $code | optional - if grantType is authorization_code
     */
    public function requestAccessToken(string $grantType, string $code): array;
}
