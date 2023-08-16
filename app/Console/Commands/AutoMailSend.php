<?php

namespace App\Console\Commands;

use App\Jobs\ReportJob;
use Illuminate\Console\Command;
use App\Models\Ticket;
use Illuminate\Support\Facades\Artisan;

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
                if (isset($ticket->assignee) && isset($ticket->assignee->email)) {
                    dispatch(new ReportJob($ticket));
                }
            }
        }

        Artisan::call('queue:work --rest=30 --stop-when-empty');
    }
}
