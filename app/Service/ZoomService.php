<?php

namespace App\Service;

use App\Exceptions\ZoomServiceException;
use App\Factory\ZoomAuthFactory;
use App\Models\ZoomAccount;
use App\Repository\ZoomAccessTokenRepository;
use App\Service\Contract\ZoomServiceContract;
use Illuminate\Support\Facades\Http;

class ZoomService implements ZoomServiceContract
{
    private ZoomAuthFactory $factory;

    public const ZOOMAPIURL = 'https://api.zoom.us/v2';

    public function __construct(ZoomAccount $account = null)
    {
        $this->factory = new ZoomAuthFactory;

        if(!is_null($account)) $this->setDefaultAccount($account);
    }

    public function linkAccount(string $code)
    {
        $token = $this->factory->requestAccessToken('authorization_code', $code);
        if(isset($token['error'])) throw new ZoomServiceException('Invalid auth code');

        $user = Http::withHeaders([
                        'Authorization' => "Bearer" . $token['access_token']
                    ])->get(self::ZOOMAPIURL . "/users/me")->json();
        
        (new ZoomAccessTokenRepository)->store($user['email'], $token);
    }

    public function account(): object
    {
        $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->token_access_token}"
            ])->get(self::ZOOMAPIURL . "/users/me");

        return (object)$response->json();
    }

    private function setDefaultAccount(ZoomAccount $account)
    {

    }
}
