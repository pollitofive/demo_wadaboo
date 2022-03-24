<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Mail\EmailUnaOfertaFueSuperada;

class NotificationSeSuperoUnaOferta extends Notification
{
    private $oferta;

    public function __construct($oferta)
    {
        $this->oferta = $oferta;
    }

    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new EmailUnaOfertaFueSuperada($this->oferta));
    }

    public function toArray($notifiable)
    {
        return $this->oferta->toArray();
    }
}
