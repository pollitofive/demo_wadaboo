<?php

namespace App\Notifications;

use App\Mail\EmailProcesoFinalizadoComprador;
use Illuminate\Notifications\Notification;

class NotificationUnProcesoHaFinalizadoComprador extends Notification
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
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new EmailProcesoFinalizadoComprador($this->proceso,$this->user));
    }

    public function toArray($notifiable)
    {
        return $this->proceso->toArray();
    }
}
