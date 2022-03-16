<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\{Package, Pricing};
use App\Service\AccountService;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function detail(Package $package, Pricing $pricing)
    {
        if(!AccountService::isComplete(Auth::user())) {
            return redirect()
                    ->route('member.profile.index')
                    ->with('alert_i', 'Anda harus melengkapi profil terlebih dahulu');
        }

        $title = "Booking {$package->title} | ". config('app.name');
        return view('member.booking', compact('package', 'pricing', 'title'));
    }
}
