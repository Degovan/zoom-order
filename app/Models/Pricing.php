<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'package_id',
        'max_audience',
        'cost',
        'discount'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
