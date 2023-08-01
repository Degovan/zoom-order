<?php

namespace App\Factory;

use App\Contracts\Messageable;
use App\Models\User;
use App\Models\ZoomMeeting;

class MeetingMessageFactory implements Messageable
{
    public function __construct(
        protected User $user,
        protected ZoomMeeting $meeting
    ){}

    public function toText(): string
    {
        $message = "Berikut adalah link meeting acara Anda\n\n======\n\n";
        $message .= "{$this->invitationText()}\n\n";
        $message .= "======\n\n";
        $message .= "*Panduan Penggunaan*\n\n";
        $message .="Untuk menggunakan Zoom Meeting Anda harus jadi *HOST* dengan cara *CLAIM HOST* menggunakan *HOSTKEY*\n\n";
        $message .= "*Host harus diclaim agar Room bisa berjalan lebih dari 40 menit & fitur Premiun lainnya aktif*\n\n";
        $message .= "*✅ Video Panduan Jadi Host*\n";
        $message .= "Di Laptop > https://youtu.be/nhmDorVZcD0\n";
        $message .= "Di Handphone > https://youtu.be/D198ct_nGFc\n\n";
        $message .= "✅ HOSTKEY = {$this->meeting->zoom_account->host_key}";

        return $message;
    }

    private function invitationText(): string
    {
        $inv = "{$this->user->name} mengundang anda pada zoom meeting.\n\n";
        $inv .= "Topik: {$this->meeting->topic}\n";
        $inv .= "Waktu: " . $this->meeting->start->format('d M Y, H:i T') . "\n\n";
        $inv .= "Join zoom meeting:\n{$this->meeting->join_url}\n\n";
        $inv .= "Meeting ID: {$this->meeting->zoom_meeting_id}\n";
        $inv .= "Passcode: {$this->meeting->passcode}";

        return $inv;
    }
}
