<?php

namespace App\Http\Middleware\Member;

use App\Models\Order;
use App\Service\BookingService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $order = BookingService::getActiveOrder(Auth::user());

        if(!$order) {
            return redirect()
                    ->route('member.packages')
                    ->with('alert_e', 'Anda harus memesan paket terlebih dahulu');
        }

        app()->instance(Order::class, $order);

        return $next($request);
    }
}