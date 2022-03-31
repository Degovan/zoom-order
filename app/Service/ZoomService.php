<?php

namespace App\Service;

use App\Exceptions\ZoomServiceException;
use App\Factory\ZoomAuthFactory;
use App\Models\Order;
use App\Models\ZoomAccount;
use App\Models\ZoomMeeting;
use App\Repository\Zoom\MeetingRepository;
use App\Repository\ZoomAccessTokenRepository;
use App\Service\Contract\ZoomServiceContract;
use App\Service\Zoom\Account;
use Carbon\Carbon;

class ZoomService implements ZoomServiceContract
{
    public ZoomAccount|null $account;

    private ZoomAuthFactory $factory;
    private ZoomAccessTokenRepository $tokenRepo;

    public function __construct(ZoomAccount $account = null)
    {
        $this->account = $account;
        $this->factory = new ZoomAuthFactory;
        $this->tokenRepo = new ZoomAccessTokenRepository;

        if(!is_null($account)) Account::verify($account);
    }

    public function linkAccount(string $code): void
    {
        $token = $this->factory->requestAccessToken($code);
        if(isset($token['error'])) throw new ZoomServiceException('Invalid auth code');

        $user = $this->factory->getAccount((object)$token);
        $location = $this->tokenRepo->store($user['email'], $token);

        if(!Account::exist($user['email'])) {
            ZoomAccount::create([
                'email' => $user['email'],
                'auth_filename' => $location
            ]);
        }
    }

    public function createMeeting(Order $order, object $data)
    {
        $date = new Carbon("{$data->date} {$data->time}");

        if($date->greaterThan($order->till_date->addDay())) {
            return (object) [
                'status' => false,
                'message' => "Anda tidak dapat membuat meeting pada waktu tersebut"
            ];
        }

        $data = [
            'topic' => $data->topic,
            'agenda' => $data->agenda,
            'start_time' => $date->toISOString(),
            'waiting_room' => boolval($data->waiting_room),
            'meeting_authentication' => boolval($data->user_authentication),
            'password' => $data->passcode ?? '',
            'duration' => (intval($data->hours) * 60) + intval($data->minutes)
        ];

        $meeting = (new MeetingRepository($this->account))->create((object) $data);

        return MeetingRepository::save($order, $data, $meeting);
    }
}
