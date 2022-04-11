<?php

namespace App\Repository;

use App\Models\{Invoice, Package, Pricing};
use App\Service\XenditService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository
{
    public static function create(Package $package, Pricing $pricing, int $packets): Invoice
    {
        $xService = new XenditService;
        $items = json_encode([
            'title' => $package->title,
            'max_audience' => $pricing->max_audience,
            'cost' => $pricing->cost,
            'discount' => $pricing->discount,
            'packets' => $packets
        ]);

        $invoice = Invoice::create([
            'code' => static::codeGen(),
            'due' => Carbon::now()->addMinutes(30),
            'user_id' => Auth::user()->id,
            'items' => $items,
            'total' => ($pricing->cost - $pricing->discount) * $packets,
            'status' => 'unpaid'
        ]);

        $xService->createInvoice(Auth::user(), $invoice);

        return $invoice;
    }

    private static function codeGen(): int
    {
        do {
            $code = rand(100000, 999999);
        } while(Invoice::where('code', $code)->first());

        return $code;
    }
}
