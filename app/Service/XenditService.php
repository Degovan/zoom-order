<?php

namespace App\Service;

use App\Models\{Invoice as InvoiceModel, User};
use App\Repository\XenditSecretRepository;
use Xendit\Balance;
use Xendit\Exceptions\ApiException;
use Xendit\Invoice;
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
        $xInvoice = Invoice::create([
            'external_id' => "{$invoice->code}",
            'payer_email' => $user->email,
            'amount' => $invoice->total,
            'description' => $invoice->items->title,
            'invoice_duration' => 1800,
            'customer' => [
                'given_names' => $user->name,
                'email' => $user->email
            ],
            'customer_notification_preference' => [
                'invoice_created' => ['email'],
                'invoice_reminder' => ['email'],
                'invoice_paid' => ['email']
            ]
        ]);

        $invoice->update(['xendit_inv' => $xInvoice['id']]);
        return (object) $xInvoice;
    }
}
