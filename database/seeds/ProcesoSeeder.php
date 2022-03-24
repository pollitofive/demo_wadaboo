<?php
use App\Models\Item;
use App\Models\Pregunta;
use App\Models\Proceso;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProcesoSeeder extends Seeder {

    public function run() {

        $start_date = Carbon::createFromDate(date("Y"), date("m"),date("d"));
        $end_date = Carbon::createFromDate(date("Y"), date("m")+1, date("d"));

        $dates = [];
        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $aux = $date;
            $array['fecha_inicio'] = $aux->format('Y-m-d');

            if ($array['fecha_inicio'] > date('Y-m-d')) {
                $array['estado'] = 'Activo';
            } else {
                $array['estado'] = 'Finalizado';
            }

            $array['fecha_inicio'] = $aux->format('d/m/Y');
            $array['fecha_entrega'] = $end_date->format('d/m/Y');
            array_push($dates, $array);
        }

        foreach ($dates as $date) {

            $procesos = factory(Proceso::class, 2)->create([
                'fecha_inicio' => $date['fecha_inicio'],
                'fecha_entrega' => $date['fecha_entrega'],
                'estado' => $date['estado']
            ]);

            $procesos->each(function ($proceso) {

                $random_user_id = random_int(1, 10);

                $proceso->localidad_id = $proceso->user->localidad_id;
                $proceso->save();

                if($random_user_id == $proceso->user_id)
                    $random_user_id++;

                factory(Item::class, random_int(2, 6))->create(['user_id' => $proceso->user_id,'proceso_id' => $proceso->id])->each(function($item) use($proceso,$random_user_id) {

                    $item->estado = $proceso->estado;

                    $users = \App\User::where('id','<>',$proceso->user_id)->select(['id'])->get();

                    for($i= 1;$i < random_int(0,3);$i++)
                    {
                        $oferta = \App\Models\OfertaXItem::firstOrNew([
                            'item_id' => $item->id,
                            'user_id' => $users->random()->id,
                            'oferta' => random_int(50,500)
                        ]);
                        $oferta->save();
                    }

                    $proceso->items()->save($item);
                });

                factory(Pregunta::class, random_int(0, 3))->create(['user_id' => $random_user_id])->each(function($item) use($proceso) {
                    $proceso->preguntas()->save($item);
                });
            });
        }
    }

}
