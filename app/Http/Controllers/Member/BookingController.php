<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\{Package, Pricing}; 
use Illuminate\Http\Request;


class BookingController extends Controller
{
    public function detail(Package $package, Pricing $pricing)
    {
        // dd($package);
        // dd($pricing);
        $title = "Booking {$package->title} | ". config('app.name');
        return view('member.booking', compact('package', 'pricing', 'title'));
    }
}
