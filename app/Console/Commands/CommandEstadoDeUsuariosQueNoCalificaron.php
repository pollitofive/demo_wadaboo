<?php

namespace App\Console\Commands;

use App\Repositories\RepoProcesoFinalizado;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CommandEstadoDeUsuariosQueNoCalificaron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizar:calificaciones-vacias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var RepoProcesoFinalizado
     */
    private $repoProcesoFinalizado;

    public function __construct(RepoProcesoFinalizado $repoProcesoFinalizado)
    {
        parent::__construct();
        $this->repoProcesoFinalizado = $repoProcesoFinalizado;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $list = $this->repoProcesoFinalizado->getRegistrosQueNoFueronCalificadosDespuesDeUnMes();

        foreach($list as $element) {
            if($element->calificacion_vendedor === null) {
                $element->calificacion_vendedor = 1;
            }
            if($element->calificacion_comprador === null) {
               $element->calificacion_comprador = 1;
            }
            $element->fecha_confirmacion_calificacion = Carbon::now()->toDateTimeString();
            $element->save();
        }
    }
}
