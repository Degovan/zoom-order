<?php

namespace App\Factory;

use App\Repository\ZoomAppRepository;
use Illuminate\Support\Facades\Http;

class ZoomAuthFactory implements ZoomAuthFactoryContract
{
    public const AUTHURL = 'https://zoom.us/oauth';

    public function __construct()
    {
        $zoomRepo = new ZoomAppRepository;
        
        $this->zoomapp = $zoomRepo->get();
    }

    public function generateAuthUrl(): string
    {
        $queries = [
            'response_type' => 'code',
            'client_id' => $this->zoomapp->client_id,
            'redirect_uri' => $this->zoomapp->redirect_url
        ];

        return self::AUTHURL . '/authorize?' . http_build_query($queries);
    }

    public function requestAccessToken(string $grantType, string $code = null): array
    {
        match($grantType) {
            'authorization_code' => $body = $this->authorizationCodeBody($code),
            'refresh_token' => $body = $this->refreshTokenBody()
        };

        $headers = [
            'Content-Type'=> 'application/x-www-form-urlencoded',
            'Authorization' => "Basic {$this->accessTokenAuth()}"
        ];

        $url = self::AUTHURL . '/token';
        $response = Http::withHeaders($headers)->asForm()->post($url, $body);
        
        return $response->json();
    }

    /**
     * Generate base64 encoded string from client_id and client_secret
     * @return string
     */
    private function accessTokenAuth(): string
    {
        return base64_encode("{$this->zoomapp->client_id}:{$this->zoomapp->client_secret}");
    }

    private function authorizationCodeBody(string $code): array
    {
        return [
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->zoomapp->redirect_url,
        ];
    }

    private function refreshTokenBody(): array
    {
        return [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->zoomToken->access_token
        ];
    }
}
