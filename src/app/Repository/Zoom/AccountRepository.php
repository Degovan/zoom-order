<?php

namespace App\Repository\Zoom;

use App\Models\ZoomAccount;
use App\Repository\ZoomAccessTokenRepository;

class AccountRepository
{
    public string $redirect_url;

    public function __construct()
    {
        $this->redirect_url = route('zoom.add');
    }

    public function store(array $data): ZoomAccount
    {
        $data = array_merge($data, ['redirect_url' => $this->redirect_url]);
        return ZoomAccount::create($data);
    }

    public function update(ZoomAccount $account, array $data)
    {
        $account->update($data);
        return $account;
    }

    public function destroy(ZoomAccount $account)
    {
        if($account->status == 'connected') {
            (new ZoomAccessTokenRepository)->delete($account);
        }

        $account->delete();
    }

    public static function availableAccounts()
    {
        return ZoomAccount::where('status', 'connected')->get();
    }
}
