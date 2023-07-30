<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();

        return view('member.package', compact('packages'));
    }
}
