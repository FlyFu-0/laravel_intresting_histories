<?php

namespace App\Jobs;

use App\Events\GotMessage;
use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendMessage implements ShouldQueue
{
    use Queueable;

    public function __construct(public Message $message)
    {
        //
    }

    public function handle(): void
    {
        broadcast(new GotMessage($this->message));
    }
}
