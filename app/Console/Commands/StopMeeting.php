<?php

namespace App\Console\Commands;

use App\Service\MeetingService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StopMeeting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meeting:stop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop expired meetings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $results = MeetingService::stop();
        $total = count($results);
        $success = count(array_filter($results));

        Log::channel('meeting')->info("Successfully proceed {$total} meeting(s), {$success} success stopped");
    }
}
