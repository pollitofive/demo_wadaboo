<?php

namespace App\Mail;

use App\Models\OfertaXItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailUnaOfertaFueSuperada extends Mailable
{
    use Queueable, SerializesModels;
    public $oferta;

    public function __construct(OfertaXItem $oferta)
    {
        $this->oferta = $oferta;
    }

    public function build()
    {
        $this->to($this->oferta->user->email,$this->oferta->user->nombre_apellido);
        return $this->markdown('emails.una-oferta-fue-superada')
            ->subject(__('notifications.se-supero-una-oferta.subject'));
    }
}
