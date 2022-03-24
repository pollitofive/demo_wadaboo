<?php

namespace App\Notifications;

use App\Mail\EmailAlertaProcesoPublicado;
use Illuminate\Notifications\Notification;

class NotificationUnProcesoHaSidoPublicado extends Notification
{

    public $proceso;
    public $user;
    public $items;

    public function __construct($proceso,$user,$items)
    {
        $this->proceso = $proceso;
        $this->user = $user;
        $this->items = $items;
    }

    public function via($notifiable)
    {
        if($this->user->recibe_alertas)
            return ['mail','database'];

        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new EmailAlertaProcesoPublicado($this->proceso,$this->user,$this->items));
    }

    public function toArray($notifiable)
    {
        return [
            'proceso' => $this->proceso->toArray(),
            'items' => $this->items
        ];
    }
}
