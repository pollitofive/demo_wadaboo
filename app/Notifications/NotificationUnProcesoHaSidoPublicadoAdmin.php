<?php

namespace App\Notifications;

use App\Mail\EmailAlertaProcesoPublicadoAdmin;
use Illuminate\Notifications\Notification;

class NotificationUnProcesoHaSidoPublicadoAdmin extends Notification
{

    public $proceso;
    public $user;

    public function __construct($proceso,$user)
    {
        $this->proceso = $proceso;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new EmailAlertaProcesoPublicadoAdmin($this->proceso,$this->user));
    }

}
