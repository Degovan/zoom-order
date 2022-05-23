<?php

namespace App\Repository;

use App\Models\Tutorial;

class TutorialRepository
{
    public function store(array $data)
    {
        return Tutorial::create([
            'title' => $data['title'],
            'icon' => $data['icon'],
            'content' => $data['content']
        ]);
    }

    public function update(Tutorial $tutorial, array $data)
    {
        return $tutorial->update([
            'title' => $data['title'],
            'icon' => $data['icon'],
            'content' => $data['content']
        ]);
    }

    public function get()
    {
        return Tutorial::latest()->get();
    }
}
