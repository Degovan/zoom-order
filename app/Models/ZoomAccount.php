<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'zoom_app_id',
        'status',
        'host_key',
        'capacity',
        'last_synced',
        'auth_filename'
    ];

    protected $casts = [
        'last_synced' => 'timestamp'
    ];

    public function zoomApp()
    {
        return $this->belongsTo(ZoomApp::class);
    }
}
