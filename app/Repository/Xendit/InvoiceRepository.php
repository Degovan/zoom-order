<?php

namespace App\Repository\Xendit;

use App\Models\Invoice as InvoiceModel;
use App\Models\User;
use Xendit\Invoice;

class InvoiceRepository
{
    public static function get(string $id): object
    {
        return (object) Invoice::retrieve($id);
    }

    public static function create(InvoiceModel $invoice, User $user): object
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
            ],
            'success_redirect_url' => route('member.invoice.success', $invoice),
            'failure_redirect_url' => route('member.invoice.failure', $invoice)
        ]);

        return (object)$xInvoice;
    }
}
