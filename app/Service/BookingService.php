<?php

namespace App\Service;

use App\Exceptions\BookingServiceException;
use App\Models\{Invoice, Order, Package, Pricing, User, ZoomAccount};
use App\Repository\InvoiceRepository;
use DateTime;

class BookingService
{
    public static function create(Package $package, Pricing $pricing, int $days): Order
    {
        $account = static::availableAccount();
        $invoice = InvoiceRepository::create($package, $pricing, $days);

        return $invoice->order()->create([
            'zoom_account_id' => $account->id,
            'till_date' => static::tillDate($days),
            'status' => 'pending'
        ]);
    }

    public static function getActiveInvoice(User $user)
    {
        $invoice = Invoice::whereBelongsTo($user)->where('status', 'active')->limit(1)->first();

        if(!$invoice) return null;

        if($invoice->order->till_date->lessThan(date('Y-m-d'))) {
            $invoice->update(['status' => 'complete']);
            $invoice->order->update(['status' => 'finish']);
            
            return null;
        }

        return $invoice;
    }

    public static function activate(Invoice $invoice): void
    {
        $invoice->update(['status' => 'active']);
        $invoice->order->update(['status' => 'active']);
    }

    private static function availableAccount(): ZoomAccount
    {
        $usedId = Order::where('status', '!=', 'finish')->pluck('zoom_account_id');
        $account = ZoomAccount::whereNotIn('id', $usedId)->first();

        if(is_null($account)) throw new BookingServiceException('All zoom account are in use, try again tomorrow');

        return $account;
    }

    private static function tillDate(int $days): string
    {
        $nowDate = date('Y-m-d');
        $date = new DateTime($nowDate);
        
        return $date->modify("+" . ($days - 1) . " days")->format('Y-m-d');
    }
}
