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

    public function success(Invoice $invoice)
    {
        return view('member.invoice.success', compact('invoice'));
    }

    public function failure(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('member.packages')->with('alert_e', 'Silahkan lakukan pemesanan ulang');
    }

    public function datatables()
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
