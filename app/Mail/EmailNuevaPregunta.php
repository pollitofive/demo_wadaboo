<?php

namespace App\Mail;

use App\Models\Pregunta;
use Illuminate\Mail\Mailable;

class EmailNuevaPregunta extends Mailable
{
    public $pregunta;
    public $user;

    public function __construct($pregunta)
    {
        $this->pregunta = $pregunta;
        $this->user = $pregunta->proceso->user;
    }

    public function build()
    {
        return $this->to($this->user->email,$this->user->nombre_apellido)
            ->markdown('emails/alerta-nueva-pregunta')
            ->subject(__('notifications.se-hizo-una-pregunta.subject')." ".config('app.name'));
    }
}
