<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Proceso;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;

class FavoritosTest extends TestCase
{
    use RefreshDatabase,GenerateDataUserTrait;

    /** @test */
    function test_an_user_can_see_page()
    {
        $this->withoutExceptionHandling();
        $user = $this->generateUser('username','pollitofive');

        $this->actingAs($user)->get('/bookmarks')
            ->assertSee('Mis favoritos')
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
    function it_save_when_click_in_favorito()
    {
        $user = $this->generateUser('username','pollitofive');
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
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
            'user_id' => $user->id,
            'subcategoria_id' => 1
        ]);

        factory(Item::class,3)->create([
            'proceso_id' => $proceso_2->id,
            'user_id' => factory(User::class)->create(),
            'subcategoria_id' => 2
        ]);

        $this->actingAs($user)->post('/procesos/ajax_set_favorito',[
           'proceso_id' => $proceso_1->id
        ]);

        $this->assertDatabaseHas('favoritos',[
            'proceso_id' => $proceso_1->id,
            'user_id' => $user->id
        ]);

        $this->assertDatabaseMissing('favoritos',[
            'proceso_id' => $proceso_2->id,
            'user_id' => $user->id
        ]);



    }
}
