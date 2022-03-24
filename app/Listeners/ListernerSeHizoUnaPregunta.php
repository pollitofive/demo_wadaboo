<?php

namespace App\Listeners;

use App\Events\EventSeHizoUnaPregunta;
use App\Mail\EmailNuevaPregunta;
use App\Notifications\NotificationSeHizoUnaPregunta;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class ListernerSeHizoUnaPregunta implements shouldQueue
{
    use InteractsWithQueue;


    public function handle(EventSeHizoUnaPregunta $event)
    {
        $event->pregunta->proceso->user->notify(new NotificationSeHizoUnaPregunta($event->pregunta));
    }
}
