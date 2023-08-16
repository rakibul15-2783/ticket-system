<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TicketCreateSuccess;
use Illuminate\Support\Facades\Mail;
use App\Models\Ticket;

class TicketCreateSuccessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sendMail;
    public $ticket;

    public function __construct($sendMail,Ticket $ticket)
    {
        $this->sendMail = $sendMail;
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new TicketCreateSuccess($this->ticket);
        Mail::to($this->sendMail)->send($email);
    }
}
