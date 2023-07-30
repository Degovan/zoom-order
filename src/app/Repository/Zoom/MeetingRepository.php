<?php

namespace App\Repository\Zoom;

use App\Exceptions\MeetingException;
use App\Factory\ZoomAuthFactory;
use App\Models\{Order, ZoomAccount, ZoomMeeting};
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

    public function create(object $data): array
    {
        $meeting = [
            'agenda' => $data->topic,
            'topic' => $data->topic,
            'duration' => $data->end->diffInMinutes($data->start),
            'start_time' => $data->start->format('Y-m-d\TH:i:s'),
            'timezone' => 'Asia/Jakarta'
        ];

        if(strlen((string) $data->passcode) > 0) $meeting['password'] = $data->passcode;

        return $this->http->post("{$this->url}/users/me/meetings", $meeting)->json();
    }

    public function stop(ZoomMeeting $meeting)
    {
        $url = "{$this->url}/meetings/{$meeting->zoom_meeting_id}/status";
        return $this->http->put($url, ['action' => 'end'])->status() == 204;
    }

    public function delete(ZoomMeeting $meeting)
    {
        $mid = $meeting->zoom_meeting_id;
        $status = $this->http->delete("{$this->url}/meetings/{$mid}")->status();

        if($status != 204) throw new MeetingException("Tidak dapat menghapus meeting");
        return $meeting->delete();
    }

    public static function save(Order $order, ZoomAccount $account, object $data): ZoomMeeting
    {
        return ZoomMeeting::create([
            'zoom_meeting_id' => (string)$data->id,
            'user_id' => $order->user->id,
            'zoom_account_id' => $account->id,
            'order_id' => $order->id,
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
