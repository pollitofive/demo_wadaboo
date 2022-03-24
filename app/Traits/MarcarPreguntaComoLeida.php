<?php

namespace App\Traits;

trait MarcarPreguntaComoLeida
{
    public function preguntaVista($proceso_id)
    {
        foreach(auth()->user()->unReadNotifications as $notificacion)
        {
            if($notificacion->type == 'App\Notifications\NotificationSeHizoUnaPregunta')
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