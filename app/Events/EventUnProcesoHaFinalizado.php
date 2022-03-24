<?php

namespace App\Events;

use App\Models\Proceso;

class EventUnProcesoHaFinalizado
{
    public $proceso;

    public function __construct(Proceso $proceso)
    {
        $this->proceso = $proceso;
    }

}
