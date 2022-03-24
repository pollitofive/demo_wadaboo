<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\{Registered,Verified};
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

use App\Events\{EventUnProcesoHaFinalizado,
    EventUnProcesoHaSidoModificado,
    EventUnProcesoHaSidoPublicado,
    EventUnaOfertaFueSuperada,
    EventSeHizoUnaPregunta,
    EventSeRespondioUnaPregunta};
use App\Listeners\{ListenerEnviarEmailOfertaSuperada,
    ListenerEnviarEmailAlertasProcesoModificado,
    ListenerEnviarEmailAlertasProcesoPublicado,
    ListenerEnviarEmailProcesoFinalizado,
    ListenerEnviarMailBienvenida,
    ListernerSeHizoUnaPregunta,
    ListernerSeRespondioUnaPregunta};

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        EventUnaOfertaFueSuperada::class => [
            ListenerEnviarEmailOfertaSuperada::class
        ],
        EventUnProcesoHaFinalizado::class => [
            ListenerEnviarEmailProcesoFinalizado::class
        ],
        EventUnProcesoHaSidoPublicado::class => [
            ListenerEnviarEmailAlertasProcesoPublicado::class
        ],
        Verified::class => [
            ListenerEnviarMailBienvenida::class
        ],
        EventSeHizoUnaPregunta::class => [
            ListernerSeHizoUnaPregunta::class
        ],
        EventSeRespondioUnaPregunta::class => [
            ListernerSeRespondioUnaPregunta::class
        ],
        EventUnProcesoHaSidoModificado::class => [
            ListenerEnviarEmailAlertasProcesoModificado::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
