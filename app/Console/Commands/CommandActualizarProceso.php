<?php

namespace App\Console\Commands;

use App\Models\ProcesoFinalizado;
use App\Repositories\RepoProceso;
use Illuminate\Console\Command;

class CommandActualizarProceso extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizar:procesos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el estado de las publicaciones';
    /**
     * @var RepoProceso
     */
    private $repoProceso;

    public function __construct(RepoProceso $repoProceso)
    {
        parent::__construct();
        $this->repoProceso = $repoProceso;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $procesos = $this->repoProceso->getProcesosVencidos();

        foreach($procesos as $proceso)
        {
            $proceso->finalizar();
            foreach($proceso->items as $item) {
                $this->createProcesoFinalizado($proceso,$item);
            }
        }
    }

    private function createProcesoFinalizado($proceso,$item)
    {
        //if($item->mejorOferta() == null) return;

        $mejor_oferta = $item->mejorOferta() ?? 0;

        ProcesoFinalizado::create([
            'proceso_id' => $proceso->id,
            'item_id' => $item->id,
            'user_comprador_id' => $proceso->user_id,
            'user_vendedor_id'  => $item->mejorOfertaObject()->user_id ?? null,
            'cantidad' => $item->cantidad,
            'oferta' => $item->mejorOferta() ?? null,
            'valor_total' => $item->cantidad * $mejor_oferta
        ]);
    }
}
