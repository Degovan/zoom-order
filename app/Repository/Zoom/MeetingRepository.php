<?php

namespace App\Repository\Zoom;

use App\Factory\ZoomAuthFactory;
use App\Models\User;
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

    public function create(object $data): array
    {
        $data = [
            'agenda' => $data->topic,
            'topic' => $data->topic,
            'duration' => $data->end->diffInMinutes($data->start),
            'password' => $data->passcode,
            'start_time' => $data->start->format('Y-m-d\TH:i:s'),
            'timezone' => 'Asia/Jakarta'
        ];

        return $this->http->post("{$this->url}/users/me/meetings", $data)->json();
    }

    public static function save(User $user, ZoomAccount $account, object $data): ZoomMeeting
    {
        return ZoomMeeting::create([
            'zoom_meeting_id' => $data->id,
            'user_id' => $user->id,
            'zoom_account_id' => $account->id,
            'topic' => $data->topic,
            'status' => 'waiting',
            'start' => $data->start,
            'end' => $data->end,
            'start_url' => $data->start_url,
            'join_url' => $data->join_url,
            'passcode' => $data->passcode
        ]);
    }
}
