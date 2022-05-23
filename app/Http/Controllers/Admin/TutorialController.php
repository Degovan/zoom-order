<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TutorialRequest;
use App\Models\Tutorial;
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

    public function edit(Tutorial $tutorial)
    {
        return view('admin.tutorial.edit', compact('tutorial'));
    }

    public function update(Request $request, Tutorial $tutorial)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'icon' => 'required',
            'content' => 'required|string'
        ]);

        if($request->title != $tutorial->title) {
            $request->validate(['title' => 'unique:tutorials,title']);
        }

        $this->repo->update($tutorial, $request->only(['title', 'icon', 'content']));
        return back()->with('alert_s', 'Berhasil mengedit tutorial');
    }

    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();
        return back()->with('alert_s', 'Berhasil menghapus tutorial');
    }

    public function datatables()
    {
        return datatables(Tutorial::query())
                ->addIndexColumn()
                ->addColumn('editLink', fn($tutor) => route('admin.tutorials.edit', $tutor->id))
                ->addColumn('delLink', fn($tutor) => route('admin.tutorials.destroy', $tutor->id))
                ->toJson();
    }
}
