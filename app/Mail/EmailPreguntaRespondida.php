<?php

namespace App\Mail;

use App\Models\Pregunta;
use Illuminate\Mail\Mailable;

class EmailPreguntaRespondida extends Mailable
{
    public $pregunta;
    public $user;

    public function __construct(Pregunta $pregunta)
    {
        $this->pregunta = $pregunta;
        $this->user     = $pregunta->user;
    }

    public function build()
    {
        return $this->to($this->user->email,$this->user->nombre_apellido)
            ->markdown('emails/alerta-pregunta-respondida')
            ->subject(__('notifications.se-respondio-una-pregunta.subject'));
    }
}
