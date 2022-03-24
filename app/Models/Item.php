<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model {

    protected $fillable = ['user_id', 'proceso_id', 'subcategoria_id', 'nombre', 'cantidad', 'unidad', 'especificaciones', 'estado','requiere_muestra','precio_maximo'];
    use SoftDeletes;


    public function proceso()
    {
        return $this->belongsTo('App\Models\Proceso');
    }

    public function calificaciones()
    {
        return $this->morphMany(Calificacion::class,'calificacion');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subcategoria()
    {
        return $this->belongsTo('App\Models\Subcategoria');
    }

    public function ofertas()
    {
        return $this->hasMany('App\Models\OfertaXItem')->orderBy('oferta'); //first es la mejor oferta
    }

    public function tengoOfertaPrevia()
    {
        return $this->ofertas->contains('user_id', auth()->user()->id);
    }

    public function soyGanador()
    {
        $mejor_oferta = $this->ofertas->first();
        if($mejor_oferta && $mejor_oferta->user_id == auth()->user()->id){
            return true;
        }
        return false;
    }

    public function ganador()
    {
        $mejor_oferta = $this->mejorOfertaObject();

        if(is_null($mejor_oferta))
            return false;

        return $mejor_oferta->user;

    }

    public function realizoOferta()
    {
        $ofertasxitem = $this->ofertas;
        foreach($ofertasxitem as $oferta)
        {
            if($oferta->user_id == auth()->user()->id)
                return $oferta;

        }

        return false;
    }

    public function getMejorOfertaAttribute()
    {
        if($this->ofertas->first()){
            return $this->ofertas->first()->oferta;
        }
        return 0;
    }


    public function mejorOferta()
    {
        $ofertasxitem = $this->ofertas;
        $mejor_oferta = null;
        foreach($ofertasxitem as $oferta)
        {
            if(is_null($mejor_oferta))
                $mejor_oferta = $oferta;

            if(($oferta->oferta < $mejor_oferta->oferta) || ($oferta->oferta < $mejor_oferta->oferta && $oferta->created_at < $mejor_oferta->created_at))
                $mejor_oferta = $oferta;

        }
        if($mejor_oferta)
            return $mejor_oferta->oferta;

        return null;

    }

    public function mejorOfertaObject()
    {
        $ofertasxitem = $this->ofertas;
        $mejor_oferta = null;

        foreach($ofertasxitem as $oferta)
        {
            if(is_null($mejor_oferta))
                $mejor_oferta = $oferta;

            if(($oferta->oferta < $mejor_oferta->oferta) || ($oferta->oferta < $mejor_oferta->oferta && $oferta->created_at < $mejor_oferta->created_at))
                $mejor_oferta = $oferta;

        }

        return $mejor_oferta;
    }


    public function puedeOfertar()
    {
        $mejor_oferta = $this->mejorOfertaObject();
        $oferta_realizada = $this->realizoOferta();
        if(! is_null($oferta_realizada) && !is_null($mejor_oferta))
        {
            if(optional($oferta_realizada)->oferta == optional($mejor_oferta)->oferta && optional($oferta_realizada)->created_at == optional($mejor_oferta)->created_at)
                return false;
        }

        return true;
    }

    public function cantidadOfertas()
    {
        return count($this->ofertas->toArray());
    }

    public function ganoLaSubasta()
    {
        if($this->mejorOferta() == null)
            return false;

        return $this->mejorOferta() == optional($this->realizoOferta())->oferta;

    }

    public function getResultadosSubasta($items_ids)
    {
        $data = [];
        $objUser = new User();
        $objOfertaXItem = new OfertaXItem();

        foreach ($items_ids as $item_id){
            $item = $this->find($item_id);
            $mejorOferta = $objOfertaXItem->getMejorOferta($item_id);

            $data[] = [
                'nombre_item' => $item->nombre,
                'cantidad' => $item->cantidad,
                'unidad' => $item->unidad,
                'mejor_oferta' => $mejorOferta->oferta,
                'subtotal' => $mejorOferta->oferta * $item->cantidad,
                'proveedor_nombre' => $objUser->getNombreByTipoUsuario($mejorOferta->user),
                'proveedor_tipo' => $mejorOferta->user->tipo_usuario,
                'email' => $mejorOferta->user->email,
                'telefono' => $objUser->getTelefonoByTipoUsuario($mejorOferta->user),
            ];
        }
        return (object) $data;
    }


    // Puede calificar si: 1 -> No tiene calificacion, 2-> Pasó menos de un dia desde que calificó
    public function puedeCalificar()
    {
        $calificaciones = $this->calificaciones()->where('user_id',auth()->user()->id)->get();

        if(count($calificaciones) == 0)
            return true;

        foreach($calificaciones as $calificacion)
        {
            if($calificacion->updated_at->addDays(1)->toDateTimeString() > Carbon::now()->toDateTimeString())
            {
                return true;
            }

        }

        return false;

    }


}
