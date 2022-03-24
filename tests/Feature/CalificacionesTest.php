<?php

namespace Tests\Feature;

use App\User;
use App\Models\{Calificacion, Item, OfertaXItem, Proceso, ProcesoFinalizado};
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;

class CalificacionesTest extends TestCase
{
    use RefreshDatabase,GenerateDataUserTrait;

    private $route_calificar = 'items/ajax_calificar_item';
    private $route_get_calificacion = 'items/get_calificacion';

    /** @test */
    function test_an_user_can_qualify_everything_was_great()
    {
        $this->seed(\CategoriasSeeder::class);
        $this->seed(\SubcategoriasSeeder::class);

        $usuario_comprador = factory(User::class)->create();
        $usuario_vendedor = $this->generateUser('username', 'pollitofive');

        $proceso = factory(Proceso::class)->state('test')->create([
            'user_id' => $usuario_comprador
        ]);

        $item_1 = factory(Item::class)->create([
            'user_id' => $usuario_comprador,
            'proceso_id' => $proceso->id,
            'cantidad' => 60
        ]);

        factory(OfertaXItem::class)->create([
            'item_id' => $item_1->id,
            'user_id' => $usuario_vendedor->id,
            'oferta' => 100
        ]);

        $data = [
            'item_id' => $item_1->id,
            'concreta' => 'Si',
            'calificacion' => 10,
            'comentario' => 'Todo salió bien',
            'recomendarias' => 'Si',
        ];

        factory(ProcesoFinalizado::class)->create([
            'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'user_comprador_id' => $usuario_comprador->id,
            'user_vendedor_id' => $usuario_vendedor->id,
            'cantidad' => 60,
            'oferta' => 100,
            'valor_total' => 6000
        ]);

        $this->assertDatabaseHas('procesos_finalizados',[
            'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'calificacion_comprador' => null,
            'calificacion_vendedor' => null
        ]);

        $response = $this->actingAs($usuario_vendedor)->post($this->route_calificar,$data);

        $response->assertJson(['save' => true])->assertStatus(200);

        $this->assertDatabaseHas('calificaciones',[
            'user_id' => $usuario_vendedor->id,
            'calificacion_type' => 'App\Models\Item',
            'calificacion_id' => $item_1->id,
            'concreto_operacion' => 'Si',
            'como_calificarias' => 10,
            'recomendarias' => 'Si',
            'comentario' => 'Todo salió bien',
        ]);
        $this->assertDatabaseHas('procesos_finalizados',[
           'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'calificacion_vendedor' => 1,
            'calificacion_comprador' => null,
            'fecha_confirmacion_calificacion' => null
        ]);

        $this->actingAs($usuario_comprador)->post($this->route_calificar,$data);
        $this->assertDatabaseHas('calificaciones',[
            'user_id' => $usuario_comprador->id,
            'calificacion_type' => 'App\Models\Item',
            'calificacion_id' => $item_1->id,
            'concreto_operacion' => 'Si',
            'como_calificarias' => 10,
            'recomendarias' => 'Si',
            'comentario' => 'Todo salió bien',
        ]);
        $this->assertDatabaseHas('procesos_finalizados',[
            'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'calificacion_vendedor' => 1,
            'calificacion_comprador' => 1,
            'fecha_confirmacion_calificacion' => Carbon::now()->toDateTimeString()
        ]);
    }

    /** @test */
    function test_an_user_can_qualify_everything_was_wrong()
    {
        $this->seed(\CategoriasSeeder::class);
        $this->seed(\SubcategoriasSeeder::class);

        $usuario_comprador = factory(User::class)->create();
        $usuario_vendedor = $this->generateUser('username', 'pollitofive');

        $proceso = factory(Proceso::class)->state('test')->create([
            'user_id' => $usuario_comprador
        ]);

        $item_1 = factory(Item::class)->create([
            'user_id' => $usuario_comprador,
            'proceso_id' => $proceso->id,
            'cantidad' => 60

        ]);

        factory(OfertaXItem::class)->create([
            'item_id' => $item_1->id,
            'user_id' => $usuario_vendedor->id,
            'oferta' => 100
        ]);

        $data = [
            'item_id' => $item_1->id,
            'concreta' => 'No',
            'calificacion' => 1,
            'comentario' => 'Todo salió mal',
            'recomendarias' => 'No',
        ];

        factory(ProcesoFinalizado::class)->create([
            'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'user_comprador_id' => $usuario_comprador->id,
            'user_vendedor_id' => $usuario_vendedor->id,
            'cantidad' => 60,
            'oferta' => 100,
            'valor_total' => 6000
        ]);

        $this->assertDatabaseHas('procesos_finalizados',[
            'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'calificacion_comprador' => null,
            'calificacion_vendedor' => null
        ]);

        $response = $this->actingAs($usuario_vendedor)->post($this->route_calificar,$data);

        $response->assertJson(['save' => true])->assertStatus(200);

        $this->assertDatabaseHas('calificaciones',[
            'user_id' => $usuario_vendedor->id,
            'calificacion_type' => 'App\Models\Item',
            'calificacion_id' => $item_1->id,
            'concreto_operacion' => 'No',
            'como_calificarias' => 1,
            'recomendarias' => 'No',
            'comentario' => 'Todo salió mal',
        ]);
        $this->assertDatabaseHas('procesos_finalizados',[
            'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'calificacion_vendedor' => 0,
            'calificacion_comprador' => null
        ]);

        $this->actingAs($usuario_comprador)->post($this->route_calificar,$data);
        $this->assertDatabaseHas('calificaciones',[
            'user_id' => $usuario_comprador->id,
            'calificacion_type' => 'App\Models\Item',
            'calificacion_id' => $item_1->id,
            'concreto_operacion' => 'No',
            'como_calificarias' => 1,
            'recomendarias' => 'No',
            'comentario' => 'Todo salió mal',
        ]);
        $this->assertDatabaseHas('procesos_finalizados',[
            'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'calificacion_vendedor' => 0,
            'calificacion_comprador' => 0,
            'fecha_confirmacion_calificacion' => Carbon::now()->toDateTimeString()
        ]);
    }

    /** @test */
    function test_an_user_can_see_the_calification()
    {
        $this->seed(\CategoriasSeeder::class);
        $this->seed(\SubcategoriasSeeder::class);

        $user_1 = factory(User::class)->state('particular')->create();
        $user_2 = $this->generateUser('username', 'pollitofive');

        $proceso = factory(Proceso::class)->state('test')->create([
            'user_id' => $user_1
        ]);

        $item_1 = factory(Item::class)->create([
            'user_id' => $user_1,
            'proceso_id' => $proceso->id

        ]);

        factory(OfertaXItem::class)->create([
            'item_id' => $item_1->id,
            'user_id' => $user_2->id
        ]);

        $calificacion = factory(Calificacion::class)->create([
            'user_id' => $user_2->id,
            'calificacion_id' => $item_1->id
        ]);

        $response = $this->actingAs($user_2)->post($this->route_get_calificacion,['item_id' => $item_1->id]);

        $response->assertJson([
            'cantidad' => $item_1->cantidad,
            'comentario' => $calificacion->comentario,
            'como_calificarias' => $calificacion->como_calificarias,
            'comprador' => $item_1->user->getNombreByTipoUsuario(),
            'concreto_operacion' => $calificacion->concreto_operacion,
            'producto' => $item_1->nombre,
            'puede_calificar' => $item_1->puedeCalificar(),
            'recomendarias' => $calificacion->recomendarias,
            'valor' => $item_1->mejor_oferta,
        ]);
    }

    /** @test */
    function test_an_user_cant_calificar_if_is_not_the_winner()
    {
        $this->seed(\CategoriasSeeder::class);
        $this->seed(\SubcategoriasSeeder::class);

        $user_1 = factory(User::class)->state('particular')->create();
        $user_2 = $this->generateUser('username', 'pollitofive');

        $proceso = factory(Proceso::class)->state('test')->create([
            'user_id' => $user_1
        ]);

        $item_1 = factory(Item::class)->create([
            'user_id' => $user_1,
            'proceso_id' => $proceso->id

        ]);

        factory(OfertaXItem::class)->create([
            'item_id' => $item_1->id,
            'user_id' => $user_2->id
        ]);

        $user_3 = factory(User::class)->state('particular')->create();

        $response = $this->actingAs($user_3)->post($this->route_calificar,['item_id' => $item_1->id]);

        $response->assertStatus(403)
            ->assertSee('No puedes calificar este item porque no eres el ganador');

    }


}
