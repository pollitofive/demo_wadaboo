<?php

namespace App\Notifications;

use App\Mail\EmailProcesoFinalizado;
use Illuminate\Notifications\Notification;

class NotificationUnProcesoHaFinalizado extends Notification
{
    public $proceso;
    public $user;
    public $items;

    public function __construct($proceso, $user, $items)
    {
        $this->proceso = $proceso;
        $this->user = $user;
        $this->items = $items;
    }

    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new EmailProcesoFinalizado($this->proceso,$this->user,$this->items));
    }

    public function toArray($notifiable)
    {
        return $this->proceso->toArray();
    }
}
