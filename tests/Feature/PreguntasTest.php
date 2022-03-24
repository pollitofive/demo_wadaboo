<?php

namespace Tests\Feature;

use App\Models\Pregunta;
use App\Models\Proceso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;

class PreguntasTest extends TestCase
{
    use RefreshDatabase,GenerateDataUserTrait;

    /** @test */
    function an_user_sees_the_questions_in_a_proceso()
    {
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $this->seed('ProvinciasSeeder');
        $this->seed('LocalidadesSeeder');

        $user = $this->generateUser('username','pollitofive');
        $proceso = factory(Proceso::class)->state('test')->create([
            'user_id' => $user->id
        ]);

        $pregunta = factory(Pregunta::class)->create([
            'user_id' => $user->id,
            'proceso_id' => $proceso->id
        ]);

        $this->actingAs($user)
            ->get("procesos/view/{$proceso->id}")
            ->assertSee($pregunta->pregunta)
            ->assertSee($pregunta->respuesta)
            ;



    }


    /** @test */
    function an_user_sees_the_questions_in_mis_compras()
    {
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $this->seed('ProvinciasSeeder');
        $this->seed('LocalidadesSeeder');

        $user = $this->generateUser('username','pollitofive');
        $proceso = factory(Proceso::class)->state('test')->create([
            'user_id' => $user->id
        ]);

        $pregunta = factory(Pregunta::class)->create([
            'user_id' => $user->id,
            'proceso_id' => $proceso->id
        ]);

        $this->actingAs($user)
            ->get("my-purchases")
            ->assertSee($pregunta->pregunta)
            ->assertSee($pregunta->respuesta);
    }


        /** @test */
        function an_user_sees_the_questions_in_mis_ofertas()
        {
            $this->seed('CategoriasSeeder');
            $this->seed('SubcategoriasSeeder');
            $this->seed('ProvinciasSeeder');
            $this->seed('LocalidadesSeeder');

            $user = $this->generateUser('username','pollitofive');
            $proceso = factory(Proceso::class)->state('test')->create([
                'user_id' => $user->id
            ]);

            $pregunta = factory(Pregunta::class)->create([
                'user_id' => $user->id,
                'proceso_id' => $proceso->id
            ]);

            $this->actingAs($user)
                ->get("my-offers")
                ->assertSee($pregunta->pregunta)
                ->assertSee($pregunta->respuesta);

        }


}
