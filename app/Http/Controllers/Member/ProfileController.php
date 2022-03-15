<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Repository\RegionRepository;

class ProfileController extends Controller
{
    public function index()
    {
        $provinces = (new RegionRepository)->province();

        return view('member.profile', compact('provinces'));
    }

    public function update(ProfileRequest $request)
    {

        $data =  $request->all();

        $request->user()->update($data);

        return back();
    }
}
