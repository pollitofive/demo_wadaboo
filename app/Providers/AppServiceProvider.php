<?php

namespace App\Providers;

use App\Composers\ComposerCategorias;
use App\Composers\ComposerProvincias;
use App\Composers\ComposerSelectMesAnioResumen;
use App\Composers\ComposerViewCategorias;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerViewComposers();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
         Schema::defaultStringLength(191);

        $throttleRate = config('mail.throttleToMessagesPerMin');
        if ($throttleRate) {
            $throttlerPlugin = new \Swift_Plugins_ThrottlerPlugin($throttleRate, \Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE);
            Mail::getSwiftMailer()->registerPlugin($throttlerPlugin);
        }

    }

    private function registerViewComposers()
    {
        View::composer('users.form',ComposerProvincias::class);

        View::composer('procesos.form.form',ComposerProvincias::class);
        View::composer('procesos.form.form',ComposerCategorias::class);
        View::composer('procesos.inicio',ComposerViewCategorias::class);

        View::composer('alertas.index',ComposerCategorias::class);
        View::composer('resume.index',ComposerSelectMesAnioResumen::class);

    }
}
