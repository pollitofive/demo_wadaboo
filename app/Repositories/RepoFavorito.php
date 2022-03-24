<?php


namespace App\Repositories;

use App\Models\Calificacion;
use App\Models\Favorito;
use App\Models\Item;

class RepoFavorito extends RepoBase
{

    public function getModel()
    {
        return new Favorito();
    }

    public function getFavorito($proceso_id)
    {
        return $this->getModel()->firstOrCreate(['user_id' => auth()->user()->id,'proceso_id' => $proceso_id]);
    }

}
