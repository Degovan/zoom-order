<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Service\BookingService;
use App\Service\XenditService;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('member.invoice.index');
    }

    public function show(Invoice $invoice)
    {
        XenditService::syncInvoice($invoice);
        return view('member.invoice.detail', compact('invoice'));
    }

    public function success(Invoice $invoice)
    {
        $xInvoice = XenditService::getInvoice($invoice);

        if($xInvoice->status != 'PAID') {
            return redirect()->route('member.invoice.show', $invoice)
                    ->with('alert_e', 'Mohon selesaikan pembayaran terlebih dahulu');
        }

        BookingService::activate($invoice);
        return view('member.invoice.success', compact('invoice'));
    }

    public function failure(Invoice $invoice)
    {
        XenditService::syncInvoice($invoice);

        if($invoice->status != 'unpaid') {
            return redirect()->route('member.invoice.show', $invoice);
        }

        return redirect()->route('member.packages')->with('alert_e', 'Silahkan lakukan pemesanan ulang');
    }

    public function datatables()
    {
        return datatables(Invoice::query())
                ->addIndexColumn()
                ->editColumn('due', fn($data) => $data->due->diffForHumans())
                ->editColumn('total', fn($data) => idr_format($data->total))
                ->toJson();
    }
}
