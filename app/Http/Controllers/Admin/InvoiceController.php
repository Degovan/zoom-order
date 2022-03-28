<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.invoice.index');
    }

    public function datatables()
    {
        return datatables()
        ->of(Invoice::query())
        ->addIndexColumn()
        ->addColumn('user_id', function($invoice){
            return $invoice->user->name;
        })
        ->make(true);

    }
}
