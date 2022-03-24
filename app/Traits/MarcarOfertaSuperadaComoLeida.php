<?php


namespace App\Traits;


trait MarcarOfertaSuperadaComoLeida
{
    public function OfertaSuperadaVistaPorProceso($proceso_id)
    {
        foreach(auth()->user()->unReadNotifications as $notificacion)
        {
            if($notificacion->type == 'App\Notifications\NotificationSeSuperoUnaOferta')
            {
                if($notificacion->data['item']['proceso_id'] == $proceso_id
                    && auth()->user()->id == $notificacion->notifiable_id)
                {
                    $notificacion->markAsRead();
                }
            }
        }
    }

    public function OfertaSuperadaVistaPorItem($item_id)
    {
        foreach(auth()->user()->unReadNotifications as $notificacion)
        {
            if($notificacion->type == 'App\Notifications\NotificationSeSuperoUnaOferta')
            {
                if($notificacion->data['item_id'] == $item_id
                    && auth()->user()->id == $notificacion->notifiable_id)
                {
                    $notificacion->markAsRead();
                }
            }
        }
    }

}