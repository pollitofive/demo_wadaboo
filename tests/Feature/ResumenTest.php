<?php

namespace Tests\Feature;

use App\Models\{Item,Proceso,ProcesoFinalizado};
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\{GenerateDataUserTrait,TestCase};

class ResumenTest extends TestCase
{
    use RefreshDatabase, GenerateDataUserTrait;
    private $route_resumen = 'resume';

    /** @test */
    public function testAUserCanSeeTheCalificatedProceso()
    {
        $this->withoutExceptionHandling();
        list($usuario_vendedor, $proceso, $item_1, $proceso_finalizado,$usuario_comprador) = $this->prepareData(
            1,
            1,
            Carbon::now()->toDateTimeString()
        );

        $response = $this->actingAs($usuario_vendedor)->get($this->route_resumen);
        $response->assertSee($proceso->titulo)
            ->assertSee($item_1->nombre)
            ->assertSee($proceso_finalizado->cantidad)
            ->assertSee($proceso_finalizado->oferta)
            ->assertSee($proceso_finalizado->valor_total)
            ->assertSee($usuario_comprador->getNombreByTipoUsuario());
    }

    /** @test */
    public function testAUserCanSeeTheCalificatedProcesoJustByVendedor()
    {
        $this->withoutExceptionHandling();
        list($usuario_vendedor, $proceso, $item_1, $proceso_finalizado,$usuario_comprador) = $this->prepareData(
            0,
            1,
            Carbon::now()->toDateTimeString()
        );

        $response = $this->actingAs($usuario_vendedor)->get($this->route_resumen);
        $response->assertSee($proceso->titulo)
            ->assertSee($item_1->nombre)
            ->assertSee($proceso_finalizado->cantidad)
            ->assertSee($proceso_finalizado->oferta)
            ->assertSee($proceso_finalizado->valor_total)
            ->assertSee($usuario_comprador->getNombreByTipoUsuario());
    }


    /** @test */
    public function testAUserCantSeeTheProcesosWithoutCalification()
    {
        $this->withoutExceptionHandling();
        list($usuario_vendedor, $proceso, $item_1, $proceso_finalizado,$usuario_comprador)  = $this->prepareData();

        $response = $this->actingAs($usuario_vendedor)->get($this->route_resumen);
        $response->assertDontSee($proceso->titulo)
            ->assertDontSee($item_1->nombre);
    }

    /** @test */
    public function testAUserCantSeeTheProcesosWithNegativeCalification()
    {
        $this->withoutExceptionHandling();
        list($usuario_vendedor, $proceso, $item_1, $proceso_finalizado,$usuario_comprador)  = $this->prepareData(
            0,
            0,
            Carbon::now()->toDateTimeString()
        );

        $response = $this->actingAs($usuario_vendedor)->get($this->route_resumen);
        $response->assertDontSee($proceso->titulo)
            ->assertDontSee($item_1->nombre);
    }

    /** @test */
    public function testAUserCantSeeTheProcesosWithDifferentMonth()
    {
        $this->withoutExceptionHandling();
        list($usuario_vendedor, $proceso, $item_1, $proceso_finalizado,$usuario_comprador)  = $this->prepareData(
            1,
            1,
            '2021-01-01 12:00:00'
        );
        $proceso_finalizado->created_at = "2021-04-01 12:00:00";
        $proceso_finalizado->save();

        $response = $this->actingAs($usuario_vendedor)->get("{$this->route_resumen}/04/2021");
        $response->assertDontSee($proceso->titulo)
            ->assertDontSee($item_1->nombre);
    }


    /** @test */
    public function testAUserCanSeeTheProcesosWithSameMonth()
    {
        $this->withoutExceptionHandling();
        list($usuario_vendedor, $proceso, $item_1, $proceso_finalizado,$usuario_comprador)  = $this->prepareData(
            1,
            1,
            '2021-01-01 12:00:00'
        );
        $proceso_finalizado->created_at = "2021-04-01 12:00:00";
        $proceso_finalizado->save();

        $response = $this->actingAs($usuario_vendedor)->get("{$this->route_resumen}/01/2021");
        $response->assertSee($proceso->titulo)
            ->assertSee($item_1->nombre);
    }

    private function prepareData($calificacion_comprador=null,$calificacion_vendedor=null,$fecha_confirmacion_calificacion=null): array
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

        $proceso_finalizado = factory(ProcesoFinalizado::class)->create([
            'proceso_id' => $item_1->proceso_id,
            'item_id' => $item_1->id,
            'user_comprador_id' => $usuario_comprador->id,
            'user_vendedor_id' => $usuario_vendedor->id,
            'cantidad' => $item_1->cantidad,
            'oferta' => 100,
            'valor_total' => 6000,
            'calificacion_comprador' => $calificacion_comprador,
            'calificacion_vendedor' => $calificacion_vendedor,
            'fecha_confirmacion_calificacion' => $fecha_confirmacion_calificacion
        ]);
        return array($usuario_vendedor, $proceso, $item_1, $proceso_finalizado, $usuario_comprador);
    }


}
