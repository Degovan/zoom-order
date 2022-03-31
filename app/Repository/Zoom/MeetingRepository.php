<?php

namespace App\Repository\Zoom;

use App\Factory\ZoomAuthFactory;
use App\Models\Order;
use App\Models\ZoomAccount;
use App\Models\ZoomMeeting;
use App\Repository\ZoomAccessTokenRepository;
use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class MeetingRepository
{
    private ZoomAccount $account;
    private PendingRequest $http;
    private string $url;

    public function __construct(ZoomAccount $account)
    {
        $token = (new ZoomAccessTokenRepository)->get($account);

        $this->account = $account;
        $this->url = ZoomAuthFactory::APIURL;
        $this->http = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$token->access_token}"
        ]);
    }

    public function create(object $data)
    {
        $data = [
            "agenda" => $data->agenda,
            "duration" => $data->duration,
            "password" => $data->password,
            "settings" => [
                "waiting_room" => $data->waiting_room,
                "meeting_authentication" => $data->meeting_authentication
            ],
            "start_time" => $data->start_time,
            "timezone" => "Asia/Jakarta",
            "topic" => $data->topic
        ];

        return $this->http->post("$this->url/users/me/meetings", $data)->json();
    }

    public static function save(Order $order, array $data, array $meeting): ZoomMeeting
    {
        $date = new Carbon($data['start_time'], config('app.timezone'));

        return ZoomMeeting::create([
            'zoom_meeting_id' => $meeting['id'],
            'user_id' => $order->invoice->user->id,
            'order_id' => $order->id,
            'host_email' => $meeting['host_email'],
            'topic' => $data['topic'],
            'status' => 'waiting',
            'start_time' => $date->format('Y-m-d H:i:s'),
            'until_time' => $date->addMinutes($data['duration'])->format('Y-m-d H:i:s'),
            'start_url' => $meeting['start_url'],
            'join_url' => $meeting['join_url'],
            'passcode' => $data['password'],
            'settings' => $meeting['settings']
        ]);
    }
}
