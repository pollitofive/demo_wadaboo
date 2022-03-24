<?php

namespace App\Notifications;

use App\Mail\EmailPreguntaRespondida;
use Illuminate\Notifications\Notification;

class NotificationSeRespondioUnaPregunta extends Notification
{
    private $pregunta;

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
        return (new EmailPreguntaRespondida($this->pregunta,$this->pregunta->user));
    }

    public function toArray($notifiable)
    {
        return $this->pregunta->toArray();
    }
}
