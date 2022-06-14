<?php

namespace App\Service;

use App\Exceptions\MeetingException;
use App\Models\{Invoice, Order, ZoomAccount, ZoomMeeting};
use App\Repository\Zoom\MeetingRepository;
use Carbon\Carbon;

class MeetingService
{
    public static function create(Order $order, $data): ZoomMeeting
    {
        $maxAudience = $order->invoice->items->max_audience;
        $account = static::findAccount($maxAudience, $data->date);
        $time = Carbon::parse("$data->date $data->time");

        if($time->lt(Carbon::now())) {
            throw new MeetingException("Tidak dapat membuat meeting pada tanggal ini");
        }

        $data = [
            'topic' => $data->topic,
            'agenda' => $data->agenda,
            'passcode' => $data->passcode,
            'start' => $time,
            'end' => Carbon::parse($time)->endOfDay()
        ];

        $meeting = (new MeetingRepository($account))->create((object)$data);
        $meeting = array_merge($meeting, [
            'start' => $time,
            'end' => $data['end'],
            'passcode' => $data['passcode']
        ]);

        return MeetingRepository::save($order, $account, (object)$meeting);
    }

    public static function stop(ZoomMeeting $meeting = null)
    {
        if($meeting instanceof ZoomMeeting) {
            $status = (new MeetingRepository($meeting->zoom_account))->stop($meeting);
            if($status) $meeting->update(['status' => 'finish']);

            return $status;
        }

        $statuses = [];
        $meetings = ZoomMeeting::where('end', '<', date('Y-m-d H:i:s'))
                                ->whereNot('status', 'finish')
                                ->get();
        
        foreach($meetings as $meeting) {
            $status = (new MeetingRepository($meeting->zoom_account))->stop($meeting);
            
            if($status) $meeting->update(['status' => 'finish']);
            $statuses[] = $status;
        }

        return $statuses;
    }

    public static function cancel(ZoomMeeting $meeting)
    {
        (new MeetingRepository($meeting->zoom_account))->delete($meeting);
    }

    private static function findAccount(int $max, $date): ZoomAccount
    {
        $ids = ZoomMeeting::whereDate('start', $date)
                    ->get()
                    ->pluck('zoom_account_id')
                    ->toArray();

        $account = ZoomAccount::whereNotIn('id', $ids)
                        ->where('status', 'connected')
                        ->where('capacity', '>=', $max)
                        ->limit(1)
                        ->first();

        if(!$account) {
            throw new MeetingException("Tidak dapat membuat meeting pada tanggal ini");
        }

        return $account;
    }
}
