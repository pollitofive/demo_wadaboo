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

class ComposerViewCategorias
{

    public function compose(View $view)
    {
        $view->categorias = $this->getCategorias();
    }

    private function getCategorias()
    {
        return Categoria::all();
    }


}
