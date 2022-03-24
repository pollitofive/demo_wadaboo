<?php

namespace App\Notifications;

use App\Mail\EmailAlertaProcesoModificado;
use Illuminate\Notifications\Notification;

class NotificationUnProcesoHaSidoModificado extends Notification
{
    public $proceso;
    public $user;

    public function __construct($proceso, $user)
    {
        $this->proceso = $proceso;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        if($this->user->recibe_alertas)
            return ['mail','database'];

        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new EmailAlertaProcesoModificado($this->proceso,$this->user));
    }

    public function toArray($notifiable)
    {
        return [
            'proceso' => $this->proceso->toArray(),
        ];
    }
}
