<?php

namespace App\Service;

use App\Exceptions\BookingServiceException;
use App\Models\Order;
use App\Models\Package;
use App\Models\Pricing;
use App\Models\ZoomAccount;
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
