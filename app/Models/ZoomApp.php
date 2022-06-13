<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomApp extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'client_id', 'client_secret', 'redirect_url'
    ];

    public function zoomAccount()
    {
        return $this->hasOne(ZoomAccount::class);
    }
}
