<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'icon', 'content'
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function($model) {
            $model->slug = Str::slug($model->title, '-');
        });
    }
}
