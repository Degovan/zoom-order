<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'zoom_meeting_id',
        'user_id',
        'order_id',
        'host_email',
        'topic',
        'status',
        'start_time',
        'until_time',
        'start_url',
        'join_url',
        'passcode',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array',
        'start_time' => 'datetime',
        'until_time' => 'datetime'
    ];
}
