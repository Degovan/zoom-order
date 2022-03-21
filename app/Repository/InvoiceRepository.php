<?php

namespace App\Repository;

use App\Models\{Invoice, Package, Pricing};
use App\Service\XenditService;
use DateTime;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository
{
    public static function create(Package $package, Pricing $pricing): Invoice
    {
        $repo = new self;
        $xService = new XenditService;
        $items = json_encode([
            'title' => $package->title,
            'max_audience' => $pricing->max_audience,
            'cost' => $pricing->cost,
            'discount' => $pricing->discount
        ]);

        $invoice = Invoice::create([
            'code' => $repo->codeGen(),
            'due' => $repo->dueDateGen(),
            'user_id' => Auth::user()->id,
            'items' => $items,
            'total' => $repo->totalGen($pricing),
            'status' => 'unpaid'
        ]);

        $xService->createInvoice(Auth::user(), $invoice);

        return $invoice;
    }

    private function codeGen(): int
    {
        do {
            $code = rand(100000, 999999);
        } while(Invoice::where('code', $code)->first());

        return $code;
    }

    private function dueDateGen(): string
    {
        $format = 'Y-m-d H:i:s';
        $date = new DateTime(date($format));

        return $date->modify('+30 minutes')->format($format);
    }

    private function totalGen(Pricing $pricing): int
    {
        return ($pricing->cost - $pricing->discount);
    }
}
