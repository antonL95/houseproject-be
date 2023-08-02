<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class UserRegisteredListener
{
    public function __construct(
    ) {
    }

    public function handle(Registered $event): void
    {
        $event->user->sendEmailVerificationNotification();
        //$mail = (new MailMessage)
        //    ->subject(Lang::get('Welcome to ') . config('app.name'))
        //    ->line(Lang::get('Please click the button below to verify your email address.'))
        //    ->action(Lang::get('Verify Email Address'), $url)
        //    ->line(Lang::get('If you did not create an account, no further action is required.'));
        //
        //$event->user->notify($mail);

        Mail::to($event->user)->send(new WelcomeMail($event->user));
    }
}
