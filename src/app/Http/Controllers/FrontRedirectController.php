<?php

namespace App\Http\Controllers;

class FrontRedirectController extends Controller
{
    public function __invoke()
    {
        $prevUrl = url()->previous();

        if($user = auth()->user()) {
            if($user->hasRole('admin')) return redirect()->route('admin.dashboard');
            return redirect()->route('member.dashboard');
        }
        
        if(str($prevUrl)->contains('admin-area'))
            return redirect()->route('admin.login');

        if(str($prevUrl)->contains('member-area'))
            return redirect()->route('member.login');
        
        return redirect('/');
    }
}
