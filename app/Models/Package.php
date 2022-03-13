<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'items'
    ];

    protected $casts = [
        'items' => 'array'
    ];

    public function pricings()
    {
        return $this->hasMany(Pricing::class);
    }
}
