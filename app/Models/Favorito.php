<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $fillable = ['user_id','proceso_id'];

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

}
