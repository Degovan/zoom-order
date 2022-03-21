<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'due', 'user_id', 'items', 'total', 'status'
    ];

    protected $casts = [
        'due' => 'datetime'
    ];

    protected function items(): Attribute
    {
        return new Attribute(
            get: fn($value) => json_decode($value)
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
