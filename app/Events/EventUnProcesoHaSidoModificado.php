<?php

namespace App\Events;

use App\Models\Proceso;

class EventUnProcesoHaSidoModificado
{
    public $proceso;

    public function __construct(Proceso $proceso)
    {
        //
        $this->proceso = $proceso;
    }

}
