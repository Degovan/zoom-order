<?php

namespace App\Service;

use App\Exceptions\ZoomServiceException;
use App\Factory\ZoomAuthFactory;
use App\Models\ZoomAccount;
use App\Repository\Zoom\MeetingRepository;
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
        $this->account = $account;
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

    public function createWebinar(array $data)
    {
        (new MeetingRepository($this->account))->create((object) $data);
    }
}
