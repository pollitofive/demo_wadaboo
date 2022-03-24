<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Subcategoria;
use CategoriasSeeder;
use SubcategoriasSeeder;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlertasTest extends TestCase
{
    use RefreshDatabase,GenerateDataUserTrait;

    /** @test */
    function test_an_user_can_see_page_alerta()
    {
        $user = $this->generateUser('username','pollitofive');


        $this->actingAs($user)
            ->get('alerts')
            ->assertSee('Configuración de Alertas E-Mail')
            ->assertSee('Deseo recibir alertas de las siguientes categorias');

    }

    /** @test */
    function a_guest_can_not_see_page()
    {
        $this->get('alerts')
            ->assertRedirect('login');

    }

    /** @test */
    function an_user_can_said_he_does_not_want_to_receive_offers()
    {
        $this->withoutExceptionHandling();
        $user = $this->generateUser('recibe_alertas','1');

        $this->actingAs($user)->post('alertas_vendedores/set_recibe_alertas',[
            'recibe_alertas' => 0
        ]);

        $this->assertDatabaseHas('users',[
            'recibe_alertas' => 0
        ]);
    }

    /** @test */
    function an_user_can_said_he__wants_to_receive_offers()
    {
        $this->withoutExceptionHandling();
        $user = $this->generateUser('recibe_alertas','0');

        $this->actingAs($user)->post('alertas_vendedores/set_recibe_alertas',[
            'recibe_alertas' => 1
        ]);

        $this->assertDatabaseHas('users',[
            'recibe_alertas' => 1
        ]);
    }

    /** @test */
    function an_user_can_add_alertas()
    {
        $user = $this->generateUser('recibe_alertas','1');

        $this->actingAs($user)->post('alertas_vendedores/ajax_set_alerta',[
            'categoria_id' => 1,
            'subcategorias' => [4,5]
        ]);

        $this->assertDatabaseHas('mail_alertas_vendedores',[
            'user_id' => $user->id,
            'categoria_id' => 1
        ]);

        $this->assertDatabaseHas('mail_alertas_vendedores_subcategorias',[
           'subcategoria_id' => 4
        ]);

        $this->assertDatabaseHas('mail_alertas_vendedores_subcategorias',[
            'subcategoria_id' => 5
        ]);

    }


    /** @test */
    function an_user_can_delete_alertas()
    {
        $user = $this->generateUser('recibe_alertas','1');

        $this->actingAs($user)->post('alertas_vendedores/ajax_set_alerta',[
            'categoria_id' => 1,
            'subcategorias' => [4,5]
        ]);

        $this->actingAs($user)->post('alertas_vendedores/ajax_set_alerta',[
            'categoria_id' => 2,
            'subcategorias' => [6,7,9]
        ]);


        $this->actingAs($user)->post('alertas_vendedores/ajax_delete',[
            'id' => 1
        ]);

        $this->assertDatabaseHas('mail_alertas_vendedores_subcategorias',[
            'subcategoria_id' => 6
        ]);

        $this->assertDatabaseHas('mail_alertas_vendedores_subcategorias',[
            'subcategoria_id' => 7
        ]);

        $this->assertDatabaseHas('mail_alertas_vendedores_subcategorias',[
            'subcategoria_id' => 9
        ]);

        $this->assertDatabaseMissing('mail_alertas_vendedores_subcategorias',[
            'subcategoria_id' => 4
        ]);

        $this->assertDatabaseMissing('mail_alertas_vendedores_subcategorias',[
            'subcategoria_id' => 5
        ]);

        $this->assertDatabaseHas('mail_alertas_vendedores',[
            'user_id' => $user->id,
            'categoria_id' => 2
        ]);

        $this->assertDatabaseMissing('mail_alertas_vendedores',[
            'user_id' => $user->id,
            'categoria_id' => 1
        ]);

    }

}
