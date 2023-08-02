<?php

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class UserRegisteredListener
{
    public function __construct(
    )
    {
    }


    public function handle(Registered $event): void
    {
        $event->user->sendEmailVerificationNotification();
        Mail::to($event->user)->send(new WelcomeMail($event->user));
    }
}
