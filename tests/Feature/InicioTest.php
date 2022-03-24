<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Proceso;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;

class InicioTest extends TestCase
{
    use RefreshDatabase, GenerateDataUserTrait;

    /** @test */
    function test_an_user_can_see_the_inicio_page()
    {
        $user = $this->generateUser('username','pollitofive');

        $this->actingAs($user)
            ->get('/home')
            ->assertSee('Nueva publicación')
            ->assertSee('Publicaciones vigentes')
            ->assertSee('Subasta')
            ->assertSee('Título de referencia')
            ->assertSee('Detalles')
            ->assertSee('Finaliza')
            ->assertSee('Entrega')
            ->assertSee('Preferencia de pago')
            ->assertSee('Cant. Items')
            ->assertSee('Ofertas')
            ->assertSee('Acciones');

    }

    /** @test */
    function test_an_user_can_see_the_inicio_page_with_data()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');

        $proceso_1 = factory(Proceso::class)->state('test')->create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);
        $proceso_2 = factory(Proceso::class)->state('test')->create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        factory(Item::class,2)->create([
            'proceso_id' => $proceso_1->id,
            'user_id' => $user->id
        ]);

        factory(Item::class,3)->create([
            'proceso_id' => $proceso_2->id,
            'user_id' => factory(User::class)->create()
        ]);




        $response = $this->actingAs($user)
            ->get('/home');

        // Proceso 1
        $response->assertSee('#'.$proceso_1->id);
        $response->assertSee($proceso_1->titulo);
        $response->assertSee($proceso_1->detalles);
        $response->assertSee($proceso_1->fecha_inicio." ".$proceso_1->hora_inicio);
        $response->assertSee($proceso_1->fecha_entrega);
        $response->assertSee($proceso_1->preferencia_pago);
        $response->assertSee(2);
        $response->assertSee(0);

        // Proceso 2
        $response->assertSee('#'.$proceso_2->id);
        $response->assertSee($proceso_2->titulo);
        $response->assertSee($proceso_2->detalles);
        $response->assertSee($proceso_2->fecha_inicio." ".$proceso_1->hora_inicio);
        $response->assertSee($proceso_2->fecha_entrega);
        $response->assertSee($proceso_2->preferencia_pago);
        $response->assertSee(3);
        $response->assertSee(0);
    }
}
