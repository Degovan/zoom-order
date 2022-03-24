<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

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

    public function datatables(Request $request)
    {
       if ($request->ajax()) {
        $data = Invoice::query();
        return FacadesDataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
       }

       return view('member.invoice.datatable');
    }
}
