<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'proceso_id' => $faker->numberBetween(1,10),
        'subcategoria_id' => $faker->numberBetween(1,176),
        'nombre' => $faker->sentence($nbWords = 2),
        'cantidad' => $faker->numberBetween(1,100),
        'unidad' => $faker->randomKey(__('unidades')),
        'especificaciones' => $faker->text(150),
        'requiere_muestra' => $faker->randomElement(['Si','No']),
        'precio_maximo' => $faker->numberBetween(100,10000)
    ];
});
