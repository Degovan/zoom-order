<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TutorialRequest;
use App\Repository\TutorialRepository;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    protected TutorialRepository $repo;

    public function __construct()
    {
        $this->repo = new TutorialRepository;
    }

    public function index()
    {
        return view('admin.tutorial.index');
    }

    public function create()
    {
        return view('admin.tutorial.create');
    }

    public function store(TutorialRequest $request)
    {
        $this->repo->store($request->only(['title', 'icon', 'content']));
        return back()->with('alert_s', 'Berhasil membuat tutorial');
    }
}
