<?php

namespace App\Mail;

use App\Models\Proceso;
use App\User;
use Illuminate\Mail\Mailable;

class EmailAlertaProcesoPublicado extends Mailable
{
    public $proceso;
    public $user;
    public $items;

    public function __construct(Proceso $proceso,User $user,$items)
    {
        //
        $this->proceso = $proceso;
        $this->user    = $user;
        $this->items   = $items;
    }

    public function build()
    {
        return $this->to($this->user->email,$this->user->nombre_apellido)
            ->markdown('emails.alerta-nueva-publicacion')
            ->subject(__('notifications.un-proceso-ha-sido-publicado.subject'));
    }
}
