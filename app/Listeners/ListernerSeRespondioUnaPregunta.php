<?php

namespace App\Listeners;

use App\Events\EventSeRespondioUnaPregunta;
use App\Notifications\NotificationSeRespondioUnaPregunta;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListernerSeRespondioUnaPregunta implements shouldQueue
{
    use InteractsWithQueue;

    public function handle(EventSeRespondioUnaPregunta $event)
    {
        $event->pregunta->user->notify(new NotificationSeRespondioUnaPregunta($event->pregunta));
        //Mail::to($event->pregunta->user->email,$event->pregunta->user->nombre_apellido)->send(new EmailPreguntaRespondida($event->pregunta));
    }
}
