<?php


namespace App\Traits;


trait MarcarProcesoFinalizadoComoLeido
{
    public function procesoFinalizadoVistoPorProceso($proceso_id)
    {
        foreach(auth()->user()->unReadNotifications as $notificacion)
        {
            if($notificacion->type == 'App\Notifications\NotificationUnProcesoHaFinalizado')
            {
                if($notificacion->data['id'] == $proceso_id
                    && auth()->user()->id == $notificacion->notifiable_id)
                {
                    $notificacion->markAsRead();
                }
            }
        }
    }

}