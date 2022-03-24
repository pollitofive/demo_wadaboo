<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAlertaProcesoModificado extends Mailable
{

    public $proceso;
    public $user;

    public function __construct($proceso, $user)
    {
        $this->proceso = $proceso;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email,$this->user->nombre_apellido)
            ->markdown('emails.alerta-publicacion-modificada')
            ->subject(__('notifications.un-proceso-ha-sido-modificado.subject'));
    }
}
