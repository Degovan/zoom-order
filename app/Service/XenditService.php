<?php

namespace App\Service;

use App\Repository\XenditSecretRepository;
use Xendit\Balance;
use Xendit\Exceptions\ApiException;
use Xendit\Xendit;

class XenditService
{
    public function __construct()
    {
        Xendit::setApiKey(XenditSecretRepository::get());
    }

    /**
     * Get balance
     * @return null|array $balances
     */
    public function balance()
    {
        try {
            $balance = [
                'cash' => Balance::getBalance('CASH')['balance'],
                'tax' => Balance::getBalance('TAX')['balance']
            ];
        } catch(ApiException $exception) {
            $balance = null;
        }

        return $balance;
    }
}
