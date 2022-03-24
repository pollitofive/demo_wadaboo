<?php


namespace App\Composers;


use Illuminate\View\View;

class ComposerSelectMesAnioResumen
{
    public function compose(View $view)
    {
        $view->meses = $this->getMeses();
        $view->anios = $this->getAnios();
    }

    private function getMeses()
    {
        return [
            '01' => __('months.january'),
            '02' => __('months.february'),
            '03' => __('months.march'),
            '04' => __('months.april'),
            '05' => __('months.may'),
            '06' => __('months.june'),
            '07' => __('months.july'),
            '08' => __('months.august'),
            '09' => __('months.september'),
            '10' => __('months.october'),
            '11' => __('months.november'),
            '12' => __('months.december')
        ];
    }

    private function getAnios()
    {
        $array = [];
        $anio_inicial = "2021";
        $anio_actual = date("Y");
        while($anio_actual >= $anio_inicial) {
            $array[$anio_actual] = $anio_actual;
            $anio_actual--;
        }

        return $array;
    }
}
