<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('member.profile');
    }

    public function update(ProfileRequest $request)
    {
        $request->user()->update(
            $request->all()
        );

        return back();
    }
}
