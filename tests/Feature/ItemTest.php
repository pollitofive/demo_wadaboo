<?php

namespace Tests\Feature;

use App\Models\Proceso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase, GenerateDataUserTrait;
    private $url = 'items/add-item';

    /** @test */
    function an_user_can_create_item()
    {
        $this->withoutExceptionHandling();
        list($user, $data) = $this->prepareData();
        $this->actingAs($user)
            ->post($this->url,$data)
            ->assertStatus(200);
        $data['estado'] = "Borrador";
        unset($data['categoria'],$data['categoria_id'],$data['desc_subcategoria'],$data['id']);

        $this->assertDatabaseHas('items',$data);


    }

    /** @test */
    function an_user_cant_create_item_in_a_deleted_proceso()
    {
        list($user, $data) = $this->prepareData('Finalizado');

        $this->actingAs($user)
            ->post($this->url,$data)
            ->assertStatus(403)
            ->assertSee('No se puede ofertar porque esta finalizado');

        $data['estado'] = "Borrador";
        unset($data['categoria'],$data['categoria_id'],$data['desc_subcategoria'],$data['id']);
        $this->assertDatabaseMissing('items',$data);

    }


    /** @test */
    function an_user_can_create_item_wihout_precio_maximo()
    {
        list($user, $data) = $this->prepareData('Activo',null);

        $this->actingAs($user)
            ->post($this->url,$data)
            ->assertStatus(200);
        $data['estado'] = "Borrador";
        unset($data['categoria'],$data['categoria_id'],$data['desc_subcategoria'],$data['id']);

        $this->assertDatabaseHas('items',$data);

    }

    private function prepareData($estado_proceso='Activo',$precio_maximo=300)
    {
        $user = $this->generateUser('username', 'pollitofive');
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');

        $proceso = Proceso::Create([
            'user_id' => $user->id,
            'estado' => $estado_proceso,
            "titulo" => 'Titulo 1',
            "fecha_inicio" => '28/01/2021',
            "hora_inicio" => '10:00:00',
            "detalles" => 'Detalle de la publicacion',
            "fecha_entrega" => '30/01/2021',
            "preferencia_pago" => 'Efectivo',
            "provincia_id" => 3,
            "localidad_id" => 282
       ]);

        $data = [
            'id' => '',
            'nombre' => 'fdgfdgfd',
            'categoria_id' => '1',
            'categoria' => 'Agricultura',
            'subcategoria_id' => '2',
            'desc_subcategoria' => 'Residuos agrícolas',
            'especificaciones' => '324',
            'cantidad' => '3',
            'unidad' => 'cajas',
            'estado' => '',
            'requiere_muestra' => 'Si',
            'proceso_id' => $proceso->id,
            "precio_maximo" => $precio_maximo
        ];
        return array($user, $data);
    }
}
