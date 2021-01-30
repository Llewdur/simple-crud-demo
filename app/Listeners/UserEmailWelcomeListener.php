<?php

namespace App\Listeners;

use App\Events\UserStoreEvent;
use App\Mail\UserWelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserEmailWelcomeListener implements ShouldQueue
{
    public $queue = 'listeners';

    public function __construct()
    {
    }

    public function handle(UserStoreEvent $event)
    {
        Mail::to($event->email)
            ->send(new UserWelcomeMail($event->user));
    }

    public function shouldQueue(UserStoreEvent $event)
    {
        return true;
    }
}
