<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Calificacion;
use Faker\Generator as Faker;

$factory->define(Calificacion::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,10),
        'calificacion_type' => 'App\Models\Item',
        'calificacion_id' => $faker->numberBetween(1,10),
        'concreto_operacion' => $faker->randomElement(['Si','No']),
        'como_calificarias' => $faker->randomElement([1,5,8,10]),
        'recomendarias' => $faker->randomElement(['Si','No']),
        'comentario' => $faker->text(),
    ];
});
