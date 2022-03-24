<?php

namespace App\Http\Controllers;

use App\Events\{EventUnProcesoHaSidoModificado,EventUnProcesoHaSidoPublicado};
use App\Models\{Proceso, Pregunta, ProcesoFinalizado};
use App\Repositories\{RepoItem,RepoProceso};
use App\Traits\{MarcarOfertaSuperadaComoLeida,
    MarcarPreguntaComoLeida,
    MarcarProcesoFinalizadoComoLeido,
    MarcarProcesoPublicadoComoLeido,
    MarcarRespuestaComoLeida};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcesosController extends Controller {

    private $repoProceso;
    private $repoItem;

    use MarcarPreguntaComoLeida;
    use MarcarRespuestaComoLeida;
    use MarcarOfertaSuperadaComoLeida;
    use MarcarProcesoPublicadoComoLeido;
    use MarcarProcesoFinalizadoComoLeido;

    public function __construct(RepoProceso $repoProceso,RepoItem $repoItem)
    {
        $this->repoProceso = $repoProceso;
        $this->repoItem = $repoItem;
    }

    public function inicio()
    {
        $activas = $this->repoProceso->getProcesosActivos();
        return view("procesos.inicio", compact('activas'));
    }

    public function misCompras($proceso_id=false)
    {
        $procesos = $this->repoProceso->getProcesosByUserId(auth()->user()->id);
        $activas = $this->repoProceso->getPublicacionesActivas($procesos);
        $finalizadas = $this->repoProceso->getProcesosFinalizados();
        $publicaciones_calificables = $this->repoProceso->getPublicacionesCalificables();
        $mostrar_finalizadas = false;
        if($proceso_id)
        {
            $mostrar_finalizadas = true;
            $this->procesoFinalizadoVistoPorProceso($proceso_id);
        }

        //$preguntas_pendientes = $this->repoProceso->getPreguntasPendientes($activas);
        $preguntas = $this->repoProceso->getPreguntasDeUsuario($procesos);


        return view('procesos.my-purchases', compact('activas', 'finalizadas','mostrar_finalizadas','preguntas','publicaciones_calificables'));
    }

    public function misOfertas($proceso_id=false)
    {
        $mis_ofertas = $this->repoProceso->getMisOfertas();
        $activas = $this->repoProceso->getOfertasActivas($mis_ofertas);
        $finalizadas = $this->repoProceso->getOfertasGanadas();
        $mostrar_finalizadas = false;
        if($proceso_id)
        {
            $mostrar_finalizadas = 'finalizadas';
            $this->procesoFinalizadoVistoPorProceso($proceso_id);
        }


        $preguntas = Pregunta::where('user_id',Auth::user()->id)->get();

        return view('procesos.my-offers',compact('activas','finalizadas','mostrar_finalizadas','preguntas'));

    }


    public function create()
    {
        if(! auth()->user()->puedeOfertar())
            return redirect('my-accounts-settings')->with('error', __('proceso.messages.you-should-complete-profile'));

        $proceso = $this->repoProceso->chequearProcesoCreado();
        if(isset($proceso->items) && count($proceso->items) > 0)
        {
            $proceso->SetCategoriaYSubcategoriaEnItems();
            return view("procesos.form.restore-items", compact('proceso'));
        }
        return view("procesos.form.form");
    }

    public function edit(Proceso $proceso)
    {
        abort_unless($proceso->esProcesoPropio(),404);

        $proceso->SetCategoriaYSubcategoriaEnItems();

        return view("procesos.form.form", compact('proceso'));

    }

    public function store(Request $request)
    {
        $proceso = $this->repoProceso->getProcesoNuevoOBorrador($request->get('id'));
        $proceso = $this->repoProceso->setDataToSave($proceso,$request);

        $enviar_mail_proceso_modificado = false;
        if($proceso->getDirty())
        {
            $proceso->save();
            $enviar_mail_proceso_modificado = true;
        }

        $this->repoItem->actualizarEstado($proceso->id,'En Proceso');

        $this->executeEvent($proceso,$request->get('id'),$enviar_mail_proceso_modificado);

        return ['save' => true];
    }

    private function executeEvent($proceso,$id,$enviar_mail_proceso_modificado)
    {
        $es_nuevo = (empty($id)) ? true : false;

        if($es_nuevo) {
            Event(new EventUnProcesoHaSidoPublicado($proceso));
        } else if($enviar_mail_proceso_modificado) {
            Event(new EventUnProcesoHaSidoModificado($proceso));
        }

    }


    public function eliminar_borrador(Proceso $proceso)
    {
        abort_if(! $proceso->esProcesoPropio(),404);
        $proceso->delete();
        return redirect('/new-auction');
    }

    public function view($proceso_id)
    {
        $proceso = $this->repoProceso->getProcesoByIdWithRelationships($proceso_id);
        abort_unless($proceso,404,__('proceso.publication-not-found'));
        //si la publicacion está finalizada, solo podrán verla los participantes
        if($proceso->estaFinalizado() && ! $proceso->soyUsuarioParticipante()){
            abort_unless($proceso,404,__('proceso.the-publication-has-been-finalised'));
        }

        $this->verificarNotificaciones($proceso_id);

        return view('procesos.view.view',compact('proceso'));
    }

    public function watchResults($proceso_id)
    {
        $proceso_finalizado = ProcesoFinalizado::with('proceso', 'item.ofertas.user')->where('proceso_id',$proceso_id)->get();
        abort_unless($proceso_finalizado->first()->proceso->esProcesoPropio(),404);
        return view('procesos.watch-results',compact('proceso_finalizado'));
    }


    public function verificarNotificaciones($proceso_id)
    {
        $this->preguntaVista($proceso_id);
        $this->RespuestaVista($proceso_id);
        $this->OfertaSuperadaVistaPorProceso($proceso_id);
        $this->procesoPublicadoVistoPorProceso($proceso_id);
        $this->procesoFinalizadoVistoPorProceso($proceso_id);

    }

     public function finalizarPublicacion(Request $request)
    {
        $proceso = $this->repoProceso->getModelById($request->get('proceso_id'));

        abort_if(! $proceso->esProcesoPropio(),403,__('proceso.it-is-not-possible-to-delete-the-publication'));

        if($proceso->sePuedeEliminar()){
            $proceso->delete();
            return response()->json(['mensaje' => 'OK'],200);
        }

        return response()->json(['message' => __('proceso.it-is-not-possible-to-remove-the-publication-because')],401);
    }


}
