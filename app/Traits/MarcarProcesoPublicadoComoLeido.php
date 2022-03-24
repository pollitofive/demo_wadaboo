<?php


namespace App\Traits;


trait MarcarProcesoPublicadoComoLeido
{
    public function procesoPublicadoVistoPorProceso($proceso_id)
    {
        foreach(auth()->user()->unReadNotifications as $notificacion)
        {
            if($notificacion->type == 'App\Notifications\NotificationUnProcesoHaSidoPublicado')
            {
                if($notificacion->data['proceso']['id'] == $proceso_id
                    && auth()->user()->id == $notificacion->notifiable_id)
                {
                    $notificacion->markAsRead();
                }
            }
        }
    }

}