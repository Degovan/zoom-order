<?php

namespace App\Http\Controllers\Member;

use App\Exceptions\BookingServiceException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\BookingRequest;
use App\Models\{Package, Pricing};
use App\Service\AccountService;
use App\Service\BookingService;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function detail(Package $package, Pricing $pricing)
    {
        $user = Auth::user();
        $region = AccountService::region($user);

        if(!AccountService::isComplete($user)) {
            return redirect()
                    ->route('member.profile.index')
                    ->with('alert_i', 'Anda harus melengkapi profil terlebih dahulu');
        }

        return view('member.booking', [
            'title' => "Booking {$package->title} | ". config('app.name'),
            'package' => $package,
            'pricing' => $pricing,
            'user' => $user,
            'region' => $region
        ]);
    }

    public function store(Package $package, Pricing $pricing, BookingRequest $request)
    {
        try {
            $booking = BookingService::create($package, $pricing, intval($request->days));
            return redirect()->route('member.invoice.show', $booking->invoice);
        } catch(BookingServiceException $exception) {
            return back()->with('alert_e', $exception->getMessage());
        }
    }
}
