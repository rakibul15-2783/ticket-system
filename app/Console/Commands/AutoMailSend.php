<?php

namespace App\Console\Commands;

use App\Jobs\ReportJob;
use Illuminate\Console\Command;
use App\Models\Ticket;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

class AutoMailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:mailsend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to super admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tickets = Ticket::where('reassigned', '!=', null)->where('reassigned_time', '!=', null)->get();

        if (!$tickets->isEmpty()) {
            foreach ($tickets as $ticket) {

                $to            = new Carbon($ticket->reassigned_time);
                $from          = new Carbon(Carbon::now());
                $diffInMinutes = $to->diffInMinutes($from);

                if (isset($ticket->assignee) && $diffInMinutes > 30) {

                    dispatch(new ReportJob($ticket));

                    $ticket->reassigned = null;
                    $ticket->reassigned_time = null;
                    $ticket->save();
                }
            }
        }

        Artisan::call('queue:work --rest=15 --stop-when-empty');
    }
}
