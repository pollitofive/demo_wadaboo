<?php

namespace App\Mail;

use App\Models\Proceso;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailProcesoFinalizadoComprador extends Mailable
{
    public $proceso;
    public $user;

    public function __construct(Proceso $proceso, User $user)
    {
        $this->proceso = $proceso;
        $this->user = $user;
    }

    public function build()
    {
        return $this->to($this->user->email,$this->user->nombre_apellido)
            ->markdown('emails.proceso-finalizado-comprador')
            ->subject(__('notifications.un-proceso-ha-finalizado-comprador.subject'));
    }
}
