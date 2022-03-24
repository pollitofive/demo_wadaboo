<?php

namespace App\Mail;

use App\Models\Proceso;
use App\User;
use Illuminate\Mail\Mailable;

class EmailAlertaProcesoPublicadoAdmin extends Mailable
{
    public $proceso;
    public $user;

    public function __construct(Proceso $proceso,User $user)
    {
        //
        $this->proceso = $proceso;
        $this->user    = $user;
    }

    public function build()
    {
        return $this->to($this->user->email,$this->user->nombre_apellido)
            ->markdown('emails.alerta-nueva-publicacion-admin')
            ->subject(__('notifications.un-proceso-ha-sido-publicado.subject'));
    }
}
