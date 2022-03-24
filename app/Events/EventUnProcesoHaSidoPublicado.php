<?php

namespace App\Events;

use App\Models\Proceso;

class EventUnProcesoHaSidoPublicado
{

    public $proceso;

    public function __construct(Proceso $proceso)
    {
        $this->proceso = $proceso;
    }

}
