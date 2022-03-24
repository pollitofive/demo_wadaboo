<?php


namespace App\Repositories;


use App\Models\Item;
use Illuminate\Http\Request;

class RepoItem extends RepoBase
{

    function getModel()
    {
        return new Item();
    }

    public function actualizarEstado($proceso_id,$estado)
    {
        $this->getModel()->where('proceso_id',$proceso_id)->update(['estado' => $estado]);
    }

    public function setDataToSave(Request $request) : Item
    {
        $item = Item::firstOrNew(['id' => $request->get('id')]);
        $item->user_id = auth()->user()->id;
        $item->proceso_id = $request->get('proceso_id');
        $item->subcategoria_id = $request->get('subcategoria_id');
        $item->nombre = $request->get('nombre');
        $item->cantidad = $request->get('cantidad');
        $item->unidad = $request->get('unidad');
        $item->especificaciones = $request->get('especificaciones');
        $item->requiere_muestra = $request->get('requiere_muestra');
        $item->precio_maximo = $request->get('precio_maximo');
        $item->estado = 'Borrador';

        return $item;
    }

}
