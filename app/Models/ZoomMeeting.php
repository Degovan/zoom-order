<?php

namespace App\Models;

use App\Service\ZoomService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'zoom_meeting_id',
        'user_id',
        'zoom_account_id',
        'order_id',
        'topic',
        'status',
        'start',
        'end',
        'start_url',
        'join_url',
        'passcode'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function zoom_account()
    {
        return $this->belongsTo(ZoomAccount::class);
    }

    public function host_key()
    {
        if($this->zoom_account) {
            $account = (new ZoomService($this->zoom_account))->syncHostkey();
            return $account->host_key;
        }

        return null;
    }
}
