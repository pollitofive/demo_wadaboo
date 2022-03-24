<?php

namespace App\Notifications;

use App\Mail\EmailNuevaPregunta;
use Illuminate\Notifications\Notification;

class NotificationSeHizoUnaPregunta extends Notification
{
    public $pregunta;

    public function __construct($pregunta)
    {
        $this->pregunta = $pregunta;
    }

    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new EmailNuevaPregunta($this->pregunta));
    }

    public function toDatabase($notifiable)
    {
        return $this->pregunta->toArray();
    }
}
