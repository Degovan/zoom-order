<?php

namespace App\Repository\Zoom;

use App\Factory\ZoomAuthFactory;
use App\Models\ZoomAccount;
use App\Repository\ZoomAccessTokenRepository;
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

        $res = $this->http->post("$this->url/users/me/meetings", $data);
    }
}
