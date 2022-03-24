<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 09/06/19
 * Time: 15:06
 */

namespace App\Composers;


use App\Models\Provincia;
use Illuminate\View\View;

class ComposerProvincias
{

    public function compose(View $view)
    {
        $view->provincias = $this->getProvincias();
    }

    private function getProvincias()
    {
        return Provincia::pluck('nombre','id')->all();
    }


}