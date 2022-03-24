<?php

namespace App\Listeners;

use App\Mail\EmailBienvenidaAlSistema;
use Illuminate\Auth\Events\Verified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class ListenerEnviarMailBienvenida implements shouldQueue
{

    use InteractsWithQueue;

    public function handle(Verified $event)
    {
        Mail::to($event->user->email, $event->user->getNombreByTipoUsuario())->send(new EmailBienvenidaAlSistema($event->user));
    }
}
