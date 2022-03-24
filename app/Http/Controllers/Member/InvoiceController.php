<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('member.invoice.index');
    }

    public function show(Invoice $invoice)
    {
        return view('member.invoice.detail', compact('invoice'));
    }

    public function datatables()
    {
        $invoices = Invoice::orderBy('created_at', 'DESC')->get();

        return view('member.invoice.datatable', compact('invoices'));
    }
}
