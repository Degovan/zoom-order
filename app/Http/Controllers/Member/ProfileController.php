<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Repository\RegionRepository;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private RegionRepository $region;

    public function __construct()
    {
        $this->region = new RegionRepository;    
    }

    public function index()
    {
        $user = Auth::user();
        $districts = $user->province ? $this->region->district($user->province) : [];
        $subDistricts = $user->district ? $this->region->sub_district($user->district) : [];

        return view('member.profile', [
            'provinces' => $this->region->province(),
            'districts' => $districts,
            'subDistricts' => $subDistricts,
            'user' => $user
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $request->user()->update($request->all());

        return back()->with('alert_s', 'Profile sukses diupdate');
    }
}
