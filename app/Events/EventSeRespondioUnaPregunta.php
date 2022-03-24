<?php

namespace App\Events;

use App\Models\Pregunta;

class EventSeRespondioUnaPregunta
{
    public $pregunta;

    public function __construct(Pregunta $pregunta)
    {
        $this->pregunta = $pregunta;
    }

}
