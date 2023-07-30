<?php

namespace App\Service;

use App\Exceptions\BookingServiceException;
use App\Models\{Order,Package,Pricing, User, ZoomAccount};
use App\Repository\InvoiceRepository;
use App\Repository\Zoom\AccountRepository;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    public static function create(Package $package, Pricing $pricing, int $packets): Order
    {
        static::availableAccount($pricing->max_audience);
        $invoice = InvoiceRepository::create($package, $pricing, $packets);

        return $invoice->order()->create([
            'invoice_id' => $invoice->id,
            'user_id' => $invoice->user->id,
            'remaining' => $packets
        ]);
    }

    public static function getActiveOrder(User $user): Collection|null
    {
        return Order::whereBelongsTo($user)
                        ->where('remaining', '>', '0')
                        ->get();
    }

    private static function AvailableAccount(int $audiences)
    {
        $available = AccountRepository::availableAccounts();

        if(count($available) > 0) {
            $max = ZoomAccount::max('capacity');
            if($audiences <= intval($max)) return true;
        }

        throw new BookingServiceException('No zoom acccount are available');
    }
}
