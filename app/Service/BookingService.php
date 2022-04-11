<?php

namespace App\Service;

use App\Exceptions\BookingServiceException;
use App\Models\{Order,Package,Pricing, ZoomAccount};
use App\Repository\InvoiceRepository;

class BookingService
{
    public static function create(Package $package, Pricing $pricing, int $packets): Order
    {
        static::availableAccount($packets);
        $invoice = InvoiceRepository::create($package, $pricing, $packets);

        return $invoice->order()->create([
            'invoice_id' => $invoice->id,
            'user_id' => $invoice->user->id,
            'remaining' => $packets
        ]);
    }

    private static function AvailableAccount(int $packets)
    {
        $max = ZoomAccount::max('capacity');

        if($packets > intval($max)) {
            throw new BookingServiceException('No zoom acccount are available');
        }
    }
}
