<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Proceso;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;

class SubcategoriasTest extends TestCase
{
    use RefreshDatabase, GenerateDataUserTrait;

    /** @test */
    function test_an_user_can_see_the_page_procesosxsubcategorias()
    {
        $this->markTestIncomplete();
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username', 'pollitofive');

        $response = $this->actingAs($user)
            ->get('/procesos/agricultura/residuos-agricolas');

        $response->assertSee('Residuos agrícolas');
        $response->assertSee('Titulo de referencia');
        $response->assertSee('Detalles');
        $response->assertSee('Fecha de fin');
        $response->assertSee('Preferencia de pago');
        $response->assertSee('Cant. Items');
        $response->assertSee('Ofertas');
        $response->assertSee('Acciones');
    }

    /** @test */
    function test_an_user_can_see_procesosxsubcategorias_in_the_page()
    {
        $this->markTestIncomplete();
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username', 'pollitofive');

        $proceso_1 = factory(Proceso::class)->state('test')->create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);
        $proceso_2 = factory(Proceso::class)->state('test')->create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);
        $proceso_3 = factory(Proceso::class)->state('test')->create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        factory(Item::class,2)->create([
            'proceso_id' => $proceso_1->id,
            'user_id' => $user->id,
            'subcategoria_id' => 2
        ]);

        factory(Item::class,3)->create([
            'proceso_id' => $proceso_2->id,
            'user_id' => factory(User::class)->create(),
            'subcategoria_id' => 3
        ]);


        factory(Item::class,3)->create([
            'proceso_id' => $proceso_3->id,
            'user_id' => factory(User::class)->create(),
            'subcategoria_id' => 71
        ]);

        $response = $this->actingAs($user)
            ->get('/procesos/agricultura/residuos-agricolas');

        // Proceso 1
        $response->assertSee($proceso_1->titulo);
        $response->assertSee($proceso_1->detalles);
        $response->assertSee(2);
        $response->assertSee(0);

        // Proceso 2
        $response->assertDontSee($proceso_2->titulo);
        $response->assertDontSee($proceso_2->detalles);

        // Proceso 3
        $response->assertDontSee($proceso_3->titulo);
        $response->assertDontSee($proceso_3->detalles);


    }

}
