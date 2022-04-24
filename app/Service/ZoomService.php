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
    public ZoomAccount $account;

    private ZoomAuthFactory $factory;
    private ZoomAccessTokenRepository $tokenRepo;

    public function __construct(ZoomAccount $account = null)
    {
        $this->factory = new ZoomAuthFactory;
        $this->tokenRepo = new ZoomAccessTokenRepository;

        if(!is_null($account)) Account::verify($account);
        $this->account = $account;
    }

    public function linkAccount(string $code)
    {
        $token = $this->factory->requestAccessToken($code);
        if(isset($token['error'])) throw new ZoomServiceException('Invalid auth code');

        $user = $this->factory->getAccount((object)$token);
        $location = $this->tokenRepo->store($user['email'], $token);

        if(Account::exist($user['email'])) {
            throw new ZoomServiceException('Account has already exist');
        }

        return ZoomAccount::create([
            'email' => $user['email'],
            'host_key' => $user['host_key'],
            'auth_filename' => $location
        ]);
    }

    public function syncHostkey(ZoomAccount $accounts = null)
    {
        if(!$accounts) {
            return Account::syncHostkey($this->account);
        }
    }
}
