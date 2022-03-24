<?php


namespace App\Traits;


trait MarcarRespuestaComoLeida
{
    public function respuestaVista($proceso_id)
    {
        foreach(auth()->user()->unReadNotifications as $notificacion)
        {
            if($notificacion->type == 'App\Notifications\NotificationSeRespondioUnaPregunta')
            {
                if($notificacion->data['proceso_id'] == $proceso_id
                && auth()->user()->id == $notificacion->notifiable_id)
                {
                    $notificacion->markAsRead();
                }
            }
        }
    }
}