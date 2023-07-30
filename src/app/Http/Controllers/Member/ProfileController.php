<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Service\AccountService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $region = AccountService::region($user);

        return view('member.profile', [
            'provinces' => $region->provinces,
            'districts' => $region->districts,
            'subDistricts' => $region->sub_districts,
            'user' => $user
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $request->user()->update($request->all());

        return back()->with('alert_s', 'Profile sukses diupdate');
    }
}
