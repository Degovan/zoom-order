<?php

namespace App\Service;

use App\Exceptions\ZoomServiceException;
use App\Factory\ZoomAuthFactory;
use App\Models\ZoomAccount;
use App\Repository\ZoomAccessTokenRepository;
use App\Service\Contract\ZoomServiceContract;
use App\Service\Zoom\Account;

class ZoomService implements ZoomServiceContract
{
    private ZoomAuthFactory $factory;
    private ZoomAccessTokenRepository $tokenRepo;

    public function __construct(ZoomAccount $account = null)
    {
        $this->factory = new ZoomAuthFactory;
        $this->tokenRepo = new ZoomAccessTokenRepository;

        if(!is_null($account)) Account::verify($account);
    }

    public function linkAccount(string $code): void
    {
        $token = $this->factory->requestAccessToken($code);
        if(isset($token['error'])) throw new ZoomServiceException('Invalid auth code');

        $user = $this->factory->getAccount((object)$token);
        $location = $this->tokenRepo->store($user['email'], $token);

        if(!Account::exist($user['email'])) {
            ZoomAccount::create([
                'email' => $user['email'],
                'auth_filename' => $location
            ]);
        }
    }
}
