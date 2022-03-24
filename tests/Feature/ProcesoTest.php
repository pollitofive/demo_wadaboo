<?php

namespace Tests\Feature;

use App\Events\EventUnProcesoHaSidoModificado;
use App\Events\EventUnProcesoHaSidoPublicado;
use App\Models\Item;
use App\Models\Proceso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;

class ProcesoTest extends TestCase
{

    use RefreshDatabase,GenerateDataUserTrait;

    /** @test */
    function an_user_can_see_page_create_proceso()
    {
        $user = $this->generateUser('username','pollitofive');

        $this->actingAs($user)
            ->get('new-auction')
            ->assertSee('Paso 1: Información general de tu compra.')
            ->assertSee('duración mínima')
            ->assertSee('fecha de entrega')
            ->assertSee('aclarar todo detalle')
            ->assertSee('Título de la publicación')
            ->assertSee('Fecha fin')
            ->assertSee('Hora Inicio Subasta')
            ->assertSee('Preferencia de pago')
            ->assertSee('Detalles de la publicación')
            ->assertSee('Fecha de entrega')
            ->assertSee('Provincia')
            ->assertSee('Localidad')
            ->assertSee('Paso 2. ¿Qué necesitas comprar?')
            ->assertSee('agregar hasta 15 items')
            ->assertSee('detalles de cada uno')
            ->assertSee(utf8_decode('"Guardar"'))
            ->assertSee('Agregar item')
            ;

    }

    /** @test */
    function an_user_can_see_page_edit_proceso()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');

        $proceso = factory(Proceso::class)->create([
            'fecha_inicio' => date('d/m/Y'),
            'fecha_entrega' => date('d/m/Y'),
            'user_id' => $user->id
            ]);

        $items = factory(Item::class,5)->create([
            'proceso_id' => $proceso->id,
            'user_id' => $user->id
        ]);


        $this->actingAs($user)
            ->get('edit-publication/'.$proceso->id)
            ->assertSee($proceso->titulo)
            ->assertSee($proceso->fecha_inicio)
            ->assertSee($proceso->fecha_fin)
            ->assertSee($proceso->hora_inicio)
            ->assertSee($proceso->fecha_entrega)
            ->assertSee($proceso->detalles)
            ->assertSee($proceso->titulo)
            ;
    }

    /** @test */
    function an_user_can_create_a_proceso()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');

        Event::fake();

        $proceso = Proceso::firstOrCreate([
            'user_id' => $user->id,
            'estado' => 'Borrador']);

        Item::create([
            'user_id' => $user->id,
            'proceso_id' => $proceso->id,
            'nombre' => 'Nombre Item 1',
            'subcategoria_id' => '2',
            'especificaciones' => 'Especificaciones 2',
            'cantidad' => '4',
            'unidad' => 'kilogramos',
            'requiere_muestra' => 'No',
            'estado' => 'Borrador'
        ]);

        Item::create([
            'user_id' => $user->id,
            'proceso_id' => $proceso->id,
            'nombre' => 'Nombre Item 2',
            'subcategoria_id' => '2',
            'especificaciones' => 'Especificaciones 2',
            'cantidad' => '4',
            'unidad' => 'kilogramos',
            'requiere_muestra' => 'No',
            'estado' => 'Borrador'
        ]);

        $data = [
            "id" => '',
            "titulo" => 'Titulo 1',
            "fecha_inicio" => '28/01/2021',
            "hora_inicio" => '10:00:00',
            "detalles" => 'Detalle de la publicacion',
            "fecha_entrega" => '30/01/2021',
            "preferencia_pago" => 'Efectivo',
            "provincia_id" => 3,
            "localidad_id" => 282,
        ];


        $this->actingAs($user)
            ->post('procesos/store',$data)
            ->assertStatus(200)
            ->assertJsonFragment(['save' => true]);

        $this->assertDatabaseHas('procesos',[
            "titulo" => 'Titulo 1',
            "fecha_inicio" => '2021-01-28',
            "hora_inicio" => '10:00:00',
            "detalles" => 'Detalle de la publicacion',
            "fecha_entrega" => '2021-01-30',
            "preferencia_pago" => 'Efectivo',
            "localidad_id" => 282,
        ]);

        $this->assertDatabaseHas('items',[
            'user_id' => $user->id,
            'proceso_id' => 1,
            'subcategoria_id' => '2',
            'especificaciones' => 'Especificaciones 2',
            'cantidad' => '4',
            'unidad' => 'kilogramos',
            'estado' => 'En Proceso',
            'requiere_muestra' => 'No'
        ]);

        $this->assertDatabaseHas('items',[
            'user_id' => $user->id,
            'proceso_id' => 1,
            'nombre' => 'Nombre Item 2',
            'subcategoria_id' => '2',
            'especificaciones' => 'Especificaciones 2',
            'cantidad' => '4',
            'unidad' => 'kilogramos',
            'requiere_muestra' => 'No',
            'estado' => 'En Proceso',
        ]);


        Event::assertDispatched(EventUnProcesoHaSidoPublicado::class);
        Event::assertNotDispatched(EventUnProcesoHaSidoModificado::class);
    }

    /** @test */
    function an_user_can_update_a_proceso()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');

        Event::fake();

        $proceso = Proceso::Create([
            'user_id' => $user->id,
            'estado' => 'Activo',
            "titulo" => 'Titulo 1',
            "fecha_inicio" => '28/01/2021',
            "hora_inicio" => '10:00:00',
            "detalles" => 'Detalle de la publicacion',
            "fecha_entrega" => '30/01/2021',
            "preferencia_pago" => 'Efectivo',
            "provincia_id" => 3,
            "localidad_id" => 282,
        ]);

        Item::create([
            'user_id' => $user->id,
            'proceso_id' => $proceso->id,
            'nombre' => 'Nombre Item 1',
            'subcategoria_id' => '2',
            'especificaciones' => 'Especificaciones 2',
            'cantidad' => '4',
            'unidad' => 'kilogramos',
            'requiere_muestra' => 'No',
            'estado' => 'En Proceso'
        ]);

        Item::create([
            'user_id' => $user->id,
            'proceso_id' => $proceso->id,
            'nombre' => 'Nombre Item 2',
            'subcategoria_id' => '2',
            'especificaciones' => 'Especificaciones 2',
            'cantidad' => '4',
            'unidad' => 'kilogramos',
            'requiere_muestra' => 'No',
            'estado' => 'En Proceso'
        ]);

        $data = [
            "id" => $proceso->id,
            "titulo" => 'Titulo 2',
            "fecha_inicio" => '28/01/2021',
            "hora_inicio" => '11:00:00',
            "detalles" => 'Detalle de la publicacion 2',
            "fecha_entrega" => '30/01/2021',
            "preferencia_pago" => 'Efectivo',
            "provincia_id" => 3,
            "localidad_id" => 282,
        ];


        $this->actingAs($user)
            ->post('procesos/store',$data)
            ->assertStatus(200)
            ->assertJsonFragment(['save' => true]);

        $this->assertDatabaseHas('procesos',[
            "titulo" => 'Titulo 2',
            "fecha_inicio" => '2021-01-28',
            "hora_inicio" => '11:00:00',
            "detalles" => 'Detalle de la publicacion 2',
            "fecha_entrega" => '2021-01-30',
            "preferencia_pago" => 'Efectivo',
            "localidad_id" => 282,
        ]);

        $this->assertDatabaseHas('items',[
            'user_id' => $user->id,
            'proceso_id' => 1,
            'subcategoria_id' => '2',
            'especificaciones' => 'Especificaciones 2',
            'cantidad' => '4',
            'unidad' => 'kilogramos',
            'estado' => 'En Proceso',
            'requiere_muestra' => 'No'
        ]);

        $this->assertDatabaseHas('items',[
            'user_id' => $user->id,
            'proceso_id' => 1,
            'nombre' => 'Nombre Item 2',
            'subcategoria_id' => '2',
            'especificaciones' => 'Especificaciones 2',
            'cantidad' => '4',
            'unidad' => 'kilogramos',
            'requiere_muestra' => 'No',
            'estado' => 'En Proceso',
        ]);


        Event::assertDispatched(EventUnProcesoHaSidoModificado::class);
        Event::assertNotDispatched(EventUnProcesoHaSidoPublicado::class);
    }





}
