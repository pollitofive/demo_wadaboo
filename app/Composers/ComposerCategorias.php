<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/06/19
 * Time: 22:51
 */

namespace App\Composers;


use App\Models\Categoria;
use Illuminate\View\View;

class ComposerCategorias
{

    public function compose(View $view)
    {
        $view->categorias = $this->getCategorias();
    }

    private function getCategorias()
    {
        if(($locale = \App::getLocale()) != 'es') {
            return Categoria::pluck('nombre_'.$locale.' as nombre','id')->all();
        }

        return Categoria::pluck('nombre','id')->all();
    }


}
