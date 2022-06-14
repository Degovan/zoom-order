<?php

namespace App\Factory;

use App\Models\ZoomApp;
use Illuminate\Support\Facades\Http;

class ZoomAuthFactory
{
    public const AUTHURL = 'https://zoom.us/oauth';
    public const APIURL = 'https://api.zoom.us/v2';

    protected ZoomApp $zoomApp;

    private array $tokenHeaders;

    public function __construct(ZoomApp $app)
    {
        $this->zoomApp = $app;
        $this->tokenHeaders = [
            'Content-Type'=> 'application/x-www-form-urlencoded',
            'Authorization' => "Basic {$this->accessTokenAuth()}"
        ];
    }

    public function generateAuthUrl(): string
    {
        $queries = [
            'response_type' => 'code',
            'client_id' => $this->zoomApp->client_id,
            'redirect_uri' => $this->zoomApp->redirect_url
        ];

        return self::AUTHURL . '/authorize?' . http_build_query($queries);
    }

    public function requestAccessToken(string $code = null): array
    {
        $url = self::AUTHURL . '/token';
        $body = [
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->zoomApp->redirect_url,
        ];

        $response = Http::withHeaders($this->tokenHeaders)->asForm()->post($url, $body);
        return $response->json();
    }

    public function refreshAccessToken(object $token): array
    {
        $url = self::AUTHURL . '/token';
        $body = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $token->refresh_token
        ];

        $response = Http::withHeaders($this->tokenHeaders)->asForm()->post($url, $body);
        return $response->json();
    }

    public function getAccount(object $token): array
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => "Bearer {$token->access_token}"
        ];

        return Http::withHeaders($headers)
                    ->get(self::APIURL . '/users/me')
                    ->json();
    }

    /**
     * Generate base64 encoded string from client_id and client_secret
     * @return string
     */
    private function accessTokenAuth(): string
    {
        return base64_encode("{$this->zoomApp->client_id}:{$this->zoomApp->client_secret}");
    }
}
