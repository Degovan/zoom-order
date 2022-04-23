<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'host_key',
        'capacity',
        'auth_filename'
    ];
}
