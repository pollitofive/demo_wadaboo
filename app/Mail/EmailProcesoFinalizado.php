<?php

namespace App\Mail;

use App\Models\Proceso;
use App\User;
use Illuminate\Mail\Mailable;

class EmailProcesoFinalizado extends Mailable
{

    public $proceso;
    public $user;
    public $ofertas;

    public function __construct(Proceso $proceso, User $user, $ofertas)
    {
        $this->proceso = $proceso;
        $this->user = $user;
        $this->ofertas = $ofertas;
    }

    public function build()
    {
        $this->to($this->user->email,$this->user->nombre_apellido);
        return $this->markdown('emails.proceso-finalizado')
            ->subject(__('notifications.un-proceso-ha-finalizado.subject'));
    }
}
