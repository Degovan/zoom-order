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
        $invoice->payment_url = $xInvoice->invoice_url;
        $invoice->save();

        return (object) $xInvoice;
    }

    public static function getInvoice(InvoiceModel $invoice = null)
    {
        new self;
        
        if(is_null($invoice)) return InvoiceRepository::getAll();
        return InvoiceRepository::get($invoice->xendit_inv);
    }

    public static function syncInvoice(InvoiceModel $invoice)
    {
        if($invoice->status == 'complete') return true;

        $service = new self;
        $xInvoice = $service->getInvoice($invoice);

        if(strtolower($xInvoice->status) == 'pending') {
            $invoice->update(['status' => 'unpaid']);
        } else {
            $invoice->update(['status' => 'complete']);
        }
    }
}
