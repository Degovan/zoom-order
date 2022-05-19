<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $lastOrders = Invoice::latest()
                            ->where('status', 'complete')
                            ->where('user_id', Auth::user()->id)
                            ->limit(10)
                            ->get();

        return view('member.dashboard', compact('lastOrders'));
    }
}
