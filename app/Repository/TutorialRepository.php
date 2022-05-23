<?php

namespace App\Repository;

use App\Models\Tutorial;
use Illuminate\Support\Str;

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
}
