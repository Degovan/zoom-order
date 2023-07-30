<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function show(Tutorial $tutorial)
    {
        return view('member.tutorial', compact('tutorial'));
    }
}
