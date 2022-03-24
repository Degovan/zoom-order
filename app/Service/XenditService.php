<?php

namespace App\Service;

use App\Models\{Invoice as InvoiceModel, User};
use App\Repository\Xendit\InvoiceRepository;
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

    public function createInvoice(User $user, InvoiceModel $invoice): object
    {
        $xInvoice = InvoiceRepository::create($invoice, $user);
        $invoice->xendit_inv = $xInvoice->id;
        $invoice->save();

        return (object) $xInvoice;
    }
}
