<?php

namespace App\Models;

use App\Events\EventUnProcesoHaFinalizado;
use App\Events\UnaOfertaFueSuperada;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Proceso extends Model {

    protected $fillable = [
        'user_id', 'titulo', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'fecha_entrega', 'detalles', 'preferencia_pago',
        'localidad_id', 'estado'
    ];

    use SoftDeletes;

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function preguntas() {
        return $this->hasMany(Pregunta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function favoritos() {
        if(\Auth::check())
            return $this->hasMany(Favorito::class)->where('user_id',\Auth::user()->id);

        return $this->hasMany(Favorito::class);
    }

    public function getFechaEntregaAttribute() {
        if($this->attributes['fecha_entrega']) {

            if(\App::getLocale() == 'es') {
                return Carbon::parse($this->attributes['fecha_entrega'])->format('d/m/Y');
            }

            return Carbon::parse($this->attributes['fecha_entrega'])->format('Y-m-d');
        }
    }

    public function getFechaInicioAttribute() {
        if($this->attributes['fecha_inicio']) {

            if(\App::getLocale() == 'es') {
                return Carbon::parse($this->attributes['fecha_inicio'])->format('d/m/Y');
            }

            return Carbon::parse($this->attributes['fecha_inicio'])->format('Y-m-d');

        }
    }

    public function getFechaHoraFinAttribute() {
        if($this->attributes['fecha_inicio']) {
            if(\App::getLocale() == 'es') {
                return Carbon::parse($this->attributes['fecha_inicio'])->format('d/m/Y') . " " .  $this->attributes['hora_inicio'];
            }

            return Carbon::parse($this->attributes['fecha_inicio'])->format('Y-m-d') . " " .  $this->attributes['hora_inicio'];
        }
    }

    public function esProcesoPropio()
    {
        if(isset(\Auth::user()->id))
            return $this->user_id == \Auth::user()->id;

        return false;
    }

    public function soyUsuarioParticipante()
    {
        if($this->user_id == auth()->user()->id){
            return true;
        }
        if (!empty($this->ofertas) && in_array(auth()->user()->id,  $this->ofertas->get()->pluck('user_id'))){
            return true;
        }
        return false;
    }

    public function esFavorito()
    {
        return count($this->favoritos) > 0;
    }

    public function estaFinalizado()
    {
        return $this->estado == 'Finalizado';
    }

    public function puedeOfertarPorAlgunItem()
    {
        $items = $this->items;

        $puede_ofertar = false;
        foreach($items as $item)
        {
            if(! $item->realizoOferta() || $item->puedeOfertar())
            {
                $puede_ofertar = true;
            }
        }

        return $puede_ofertar;
    }

    public function ganoAlgunItem()
    {
        $items = $this->items;

        $gano_algun_item = false;
        foreach($items as $item)
        {
            if($item->ganoLaSubasta())
            {
                $gano_algun_item = true;
            }
        }

        return $gano_algun_item;

    }



    public function setFechaInicioAttribute($value)
    {
        if(($locale = \App::getLocale()) == 'es') {
            $datetime = DateTime::createFromFormat('d/m/Y', $value);
            return $this->attributes['fecha_inicio'] = Carbon::instance($datetime)->format('Y-m-d');
        }

        return $value;
    }

    public function setFechaEntregaAttribute($value)
    {
        if(($locale = \App::getLocale()) == 'es') {
            $datetime = DateTime::createFromFormat('d/m/Y', $value);
            return $this->attributes['fecha_entrega'] = Carbon::instance($datetime)->format('Y-m-d');
        }
        return $value;
    }

    public function SetCategoriaYSubcategoriaEnItems()
    {
        foreach($this->items as $item)
        {
            $subcategoria = $item->subcategoria->name;
            $categoria_id = $item->subcategoria->categoria->id;
            $categoria = $item->subcategoria->categoria->name;


            $item->desc_subcategoria = $subcategoria;
            $item->categoria_id = $categoria_id;
            $item->categoria = $categoria;
            $item->muestra = $item->requiere_muestra;
            $item->unidad = trans('unidades')[$item->unidad];
        }
    }

    public function getCantidadOfertasAttribute()
    {
        $items_ids = $this->items->pluck('id');
        $ofertas = OfertaXItem::whereIn('item_id', $items_ids)->get();
        return $ofertas->count();
    }

    public function getTiempoFinalizacionAttribute()
    {
        $fecha_fin = $this->attributes['fecha_inicio'] . " " . $this->attributes['hora_inicio'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $fecha_fin);

        if ($startDate > $fecha_fin) {
            return 0;
        }

        $days = str_pad($startDate->diffInDays($endDate),2,"0",STR_PAD_LEFT);
        $hours = str_pad($startDate->copy()->addDays($days)->diffInHours($endDate),2,"0",STR_PAD_LEFT);
        $minutes = str_pad($startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate),2,"0",STR_PAD_LEFT);
        $seconds = str_pad($startDate->copy()->addDays($days)->addHours($hours)->addMinutes($minutes)->diffInSeconds($endDate),2,"0",STR_PAD_LEFT);

        return $days."d ".$hours."h ".$minutes."m ".$seconds."s";
    }

    public function getFechaCompletaFinalizacionAttribute()
    {
        return $this->attributes['fecha_inicio'] . " " . $this->attributes['hora_inicio'];
    }

    public function finalizar()
    {
        foreach($this->items as $item){
            $item->estado = 'Finalizado';
            $item->save();
        }

        $this->estado = 'Finalizado';
        $this->save();
        Event(new EventUnProcesoHaFinalizado($this));
    }

    public function getUrlVerPublicacionAttribute()
    {
        return config('app.url')."/procesos/view/".$this->id;
    }

    public function sePuedeEliminar()
    {
        $se_puede_eliminar = true;
        foreach($this->items as $item)
        {
            if($item->cantidadOfertas() > 0)
                $se_puede_eliminar = false;
        }

        return $se_puede_eliminar;


    }



}
