<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Service\XenditService;
use Illuminate\Http\Request;

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

        if($xInvoice->status == 'UNPAID') {
            return redirect()->route('member.invoice.show', $invoice)
                    ->with('alert_e', 'Mohon selesaikan pembayaran terlebih dahulu');
        }

        $invoice->activate();
        return view('member.invoice.success', compact('invoice', 'xInvoice'));
    }

    public function failure(Invoice $invoice)
    {
        XenditService::syncInvoice($invoice);

        if($invoice->status != 'unpaid') {
            return redirect()->route('member.invoice.show', $invoice);
        }

        return redirect()->route('member.packages')->with('alert_e', 'Silahkan lakukan pemesanan ulang');
    }

    public function print(Invoice $invoice)
    {
        return view('member.invoice.printprev', compact('invoice'));
    }

    public function datatables(Request $request)
    {
        $invoices = Invoice::query()->where('user_id', $request->user()->id);

        return datatables($invoices)
                ->addIndexColumn()
                ->editColumn('due', fn($data) => $data->due->diffForHumans())
                ->editColumn('total', fn($data) => idr_format($data->total))
                ->toJson();
    }
}
