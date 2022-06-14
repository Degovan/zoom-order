<?php

namespace App\Service;

use App\Exceptions\ZoomServiceException;
use App\Factory\ZoomAuthFactory;
use App\Models\ZoomAccount;
use App\Repository\ZoomAccessTokenRepository;
use App\Service\Contract\ZoomServiceContract;
use App\Service\Zoom\Account;
use Carbon\Carbon;

class ZoomService implements ZoomServiceContract
{
    public ?ZoomAccount $account;

    private ZoomAuthFactory $factory;
    private ZoomAccessTokenRepository $tokenRepo;

    public function __construct(ZoomAccount $account)
    {
        $this->factory = new ZoomAuthFactory($account->zoomApp);
        $this->tokenRepo = new ZoomAccessTokenRepository;

        if($account->status == 'connected') Account::verify($account);
        $this->account = $account;
    }

    public function linkAccount(string $code): void
    {
        $token = $this->factory->requestAccessToken($code);
        if(isset($token['error'])) throw new ZoomServiceException('Invalid auth code');

        $user = $this->factory->getAccount((object)$token);
        $location = $this->tokenRepo->store($user['email'], $token);

        $this->account->update([
            'host_key' => $user['host_key'],
            'auth_filename' => $location,
            'status' => 'connected',
            'last_synced' => Carbon::now()
        ]);
    }

    public function syncHostkey(ZoomAccount $accounts = null)
    {
        if(!$accounts && $this->account instanceof ZoomAccount) {
            return Account::syncHostkey($this->account);
        }
    }
}
