<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\{Item, OfertaXItem, Pregunta, Proceso, ProcesoFinalizado, Subcategoria};
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RepoProceso extends RepoBase
{
    public function getModel()
    {
        return new Proceso();
    }

    public function getProcesoByIdWithRelationships($id)
    {
        return $this->getModel()
            ->whereId($id)
            ->with(['items.subcategoria.categoria', 'items.ofertas', 'items.proceso', 'preguntas'])->first();
    }

    public function chequearProcesoCreado()
    {
        return $this->getModel()->where('estado', 'Borrador')->where('user_id', auth()->user()->id )->first();
    }

    public function getProcesosByUserId($user_id)
    {
        $procesos = $this->getModel()->where('user_id',$user_id)->with('items.ofertas','preguntas')->get();
        foreach($procesos as $proceso){
            $proceso->setAttribute("cantidad_ofertas", $this->getCantidadOfertasPublicacion($proceso));
        }
        return $procesos;
    }

    public function getCantidadOfertasPublicacion($proceso){
        $cantidad = 0;
        foreach($proceso->items as $item){
            $cantidad += $item->ofertas->count();
        }
        return $cantidad;
    }

    public function getPublicacionesActivas(Collection $procesos) : Collection
    {
        return $procesos->filter(function ($proceso) {
            return $proceso->estado == 'Activo';
        });
    }

    public function getProcesosFinalizados()
    {
        $list = ProcesoFinalizado::where('user_comprador_id',Auth::id())->get();
        $collection = collect();
        foreach($list as $element) {
            $collection->add($element->proceso);
        }
        return $collection->unique();
    }

    public function getPublicacionesCalificables()
    {
        $list = ProcesoFinalizado::where('user_comprador_id',Auth::id())->orderBy('proceso_id')->get();
        return $list;
        /*
        $list = ProcesoFinalizado::where('user_comprador_id',Auth::id())->get();
        $collection = collect();
        foreach($list as $element) {
            $collection->add($element->proceso);
        }
        return $collection->unique();
        */
    }


    public function getProcesosActivos($user_id = null)
    {
        return $this->getModel()
            ->where('estado','Activo')
            ->with(['items.ofertas','favoritos'])
            ->orderBy('id','desc')
            ->get();
    }

    public function getProcesosPorCategoria($categoria_id)
    {
        $subcategorias = Subcategoria::where('categoria_id',$categoria_id)->pluck('id')->toArray();
        $procesos = $this->getModel()->where('user_id',\auth::id())->with(['items' => function($query) use ($subcategorias) {
            $query->whereIn('subcategoria_id',$subcategorias);
        }])->get();

        $procesos = $procesos->filter(function ($value, $key) {
            return $value->items->count() > 0;
        });

        $procesos = $this->getPublicacionesActivas($procesos);
        return $procesos;
    }

    public function getProcesosPorSubCategoria($subcategoria)
    {
        $procesos = $this->getModel()->where('user_id',\auth::id())->with(['items' => function($query) use ($subcategoria) {
            $query->where('subcategoria_id',$subcategoria);
        }])->get();

        $procesos = $procesos->filter(function ($value, $key) {
            return $value->items->count() > 0;
        });

        $procesos = $this->getPublicacionesActivas($procesos);
        return $procesos;
    }



    public function getProcesosFavoritos()
    {
        $procesos = $this->getModel()->with('items.ofertas','favoritos')->get();

        $procesos_favoritos = collect();

        foreach($procesos as $proceso){
            if($proceso->favoritos->count() > 0)
                $procesos_favoritos->push($proceso);
        }

        return $procesos_favoritos;
    }

    public function getProcesoIdBorrador()
    {
        $model = $this->getModel()->firstOrNew([
            'user_id' => auth()->user()->id,
            'estado' => 'Borrador']);
        $model->save();
        return $model->id;
    }

    public function getMisOfertas()
    {
        $items_ids = OfertaXItem::where('user_id',auth()->user()->id)->get()->pluck('item_id');
        $mis_ofertas = Item::whereIn('id', $items_ids)->with('ofertas', 'proceso', 'user', 'subcategoria.categoria','calificaciones')->get();

        return $mis_ofertas;
    }

    public function getOfertasActivas($mis_ofertas)
    {
        $filtered = $mis_ofertas->filter(function ($value, $key) {
            return $value->proceso->estado == "Activo";
        });
        return $filtered;
    }

    public function getOfertasGanadas()
    {
        $list = ProcesoFinalizado::where('user_vendedor_id',Auth::id())->orderBy('proceso_id')->get();
        return $list;
        /*
        $filtered = $mis_ofertas->filter(function ($value, $key) {
            return $value->proceso->estado == "Finalizado" && $value->ganoLaSubasta();
        });

        return $filtered;
        */
    }

    public function getProcesosVencidos()
    {
        $procesos = $this->getModel()
            ->where('estado', 'Activo')
            ->where('fecha_inicio','<=',now())
            ->get();

        // Filtro los que todavia no tienen la hora
        $procesos = $procesos->filter(function($proceso){
            if($proceso->fecha_inicio < now()) return true;
            return $proceso->hora_inicio < date("H:i:s");
        });

        return $procesos;
    }

    public function getDataFinalizada($finalizadas)
    {
        $lista = [];
        foreach($finalizadas as $id => $procesos)
        {
            $lista[$id] = $this->getModelById($id);
        }
        return $lista;
    }

    public function getItemsDelProceso($proceso_id)
    {
        return $this->getModel()->where('proceso_id',$proceso_id)->first();
    }

    public function getPreguntasDeUsuario($procesos)
    {
        $lista = [];
        foreach($procesos as $proceso) {
            array_push($lista,$proceso->id);
        }

        $preguntas = Pregunta::whereIn('proceso_id',$lista)->orderBy('created_at','desc')->get();
        return $preguntas;
    }

    public function getProcesoNuevoOBorrador($id)
    {
        if($id) {
            return $this->getModel()->where('id',$id)->first();
        }

        return $this->getModel()->where('id',$this->getProcesoIdBorrador())->first();

    }

    public function setDataToSave(Proceso $proceso,Request $request) : Proceso
    {
        $proceso->titulo = $request->get('titulo');
        $proceso->fecha_inicio = $request->get('fecha_inicio');
        $proceso->hora_inicio = $request->get('hora_inicio');
        $proceso->detalles = $request->get('detalles');
        $proceso->fecha_entrega = $request->get('fecha_entrega');
        $proceso->preferencia_pago = $request->get('preferencia_pago');
        $proceso->localidad_id = $request->get('localidad_id');
        $proceso->estado = 'Activo';
        $proceso->user_id = auth()->user()->id;

        return $proceso;
    }

}
