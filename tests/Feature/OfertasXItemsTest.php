<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\OfertaXItem;
use App\Models\Proceso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class OfertasXItemsTest extends TestCase
{
    use RefreshDatabase,GenerateDataUserTrait;

    /** @test */
    function test_an_user_can_register_an_oferta()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');
        $user2 = $this->generateUser('username','pollitofive2');

        $proceso = Proceso::Create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        $item = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 200
        ]);

        $item2 = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo'
        ]);

        $array = [];
        array_push($array,[
            'item_id' => $item->id,
            'oferta' => 150
        ]);
        array_push($array,[
            'item_id' => $item2->id,
            'oferta' => ''
        ]);

        $this->actingAs($user)->post('/ofertasxitems/ofertar',[
           'data' => json_encode($array)
        ])
            ->assertJson([
                'title' => 'Tu oferta fue registrada.',
                'message' => "Podés darle seguimiento desde el menú -> Mis Ofertas"
            ],200)
        ;

        $this->assertDatabaseHas('ofertasxitems',[
           'user_id' => $user->id,
           'item_id' => $item->id,
           'oferta' => 150
        ]);

        $this->assertDatabaseMissing('ofertasxitems',[
           'user_id' => $user->id,
           'item_id' => $item2->id,
           'oferta' => ''
        ]);
    }

    /** @test */
    function test_an_user_can_register_an_oferta_without_precio_maximo()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');
        $user2 = $this->generateUser('username','pollitofive2');

        $proceso = Proceso::Create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        $item = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => null
        ]);

        $array = [];
        array_push($array,[
            'item_id' => $item->id,
            'oferta' => 150
        ]);

        $this->actingAs($user)->post('/ofertasxitems/ofertar',[
            'data' => json_encode($array)
        ])
            ->assertJson([
                'title' => 'Tu oferta fue registrada.',
                'message' => "Podés darle seguimiento desde el menú -> Mis Ofertas"
            ],200)
        ;

        $this->assertDatabaseHas('ofertasxitems',[
            'user_id' => $user->id,
            'item_id' => $item->id,
            'oferta' => 150
        ]);

    }

    /** @test */
    function test_dont_save_an_oferta_when_it_is_bigger_than_the_precio_maximo()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');
        $user2 = $this->generateUser('username','pollitofive2');

        $proceso = Proceso::create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        $item = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 200
        ]);

        $array = [];
        array_push($array,[
            'item_id' => $item->id,
            'oferta' => 201
        ]);
        $this->actingAs($user)->post('/ofertasxitems/ofertar',[
            'data' => json_encode($array)
        ])
            ->assertJson([
                'title' => 'Tus ofertas no pudieron ser registradas',
                'message' => "Las ofertas no se guardaron porque son superiores al máximo determinado por el usuario"
            ],200);

        $this->assertDatabaseMissing('ofertasxitems',[
            'user_id' => $user->id,
            'item_id' => $item->id,
            'oferta' => 201
        ]);
    }

    /** @test */
    function test_dont_save_an_oferta_when_it_is_not_the_best()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');
        $user2 = $this->generateUser('username','pollitofive2');
        $user3 = $this->generateUser('username','pollitofive3');

        $proceso = Proceso::Create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        $item = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo'
        ]);

        OfertaXItem::create([
            'user_id' => $user3->id,
            'item_id' => $item->id,
            'oferta' => 200
        ]);

        $array = [];
        array_push($array,[
            'item_id' => $item->id,
            'oferta' => 300
        ]);

        $this->actingAs($user)->post('/ofertasxitems/ofertar',[
            'data' => json_encode($array)
        ])
            ->assertJson([
                'title' => 'Tus ofertas no pudieron ser registradas',
                'message' => "Algunas ofertas no se guardaron porque otras son superiores"
            ],200)
        ;

        $this->assertDatabaseMissing('ofertasxitems',[
            'user_id' => $user->id,
            'item_id' => $item->id,
            'oferta' => 300
        ]);
    }



    /** @test */
    function test_ofertas_winners_and_losers()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');
        $user2 = $this->generateUser('username','pollitofive2');
        $user3 = $this->generateUser('username','pollitofive3');

        $proceso = Proceso::Create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        $item1 = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 2000
        ]);

        $item2 = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 2000
        ]);

        OfertaXItem::create([
            'user_id' => $user3->id,
            'item_id' => $item1->id,
            'oferta' => 1000
        ]);

        OfertaXItem::create([
            'user_id' => $user3->id,
            'item_id' => $item2->id,
            'oferta' => 1000
        ]);

        $array = [];
        array_push($array,[
            'item_id' => $item1->id,
            'oferta' => 500
        ]);

        array_push($array,[
            'item_id' => $item2->id,
            'oferta' => 1500
        ]);

        Mail::fake();

        $this->actingAs($user)->post('/ofertasxitems/ofertar',[
            'data' => json_encode($array)
        ])
            ->assertJson([
                'title' => 'Algunas ofertas fueron registradas',
                'message' => "Podés darle seguimiento desde el menú-> Mis Ofertas. Algunas ofertas no se guardaron porque otras son superiores"
            ],200)
        ;

        $this->assertDatabaseHas('ofertasxitems',[
            'user_id' => $user->id,
            'item_id' => $item1->id,
            'oferta' => 500
        ]);
        $this->assertDatabaseMissing('ofertasxitems',[
            'user_id' => $user->id,
            'item_id' => $item2->id,
            'oferta' => 1500
        ]);
    }

    /** @test */
    function test_wrong_message()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');
        $user2 = $this->generateUser('username','pollitofive2');
        $user3 = $this->generateUser('username','pollitofive3');

        $proceso = Proceso::Create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        $item1 = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 10000
        ]);

        $item2 = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 10000
        ]);

        $item3 = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 10000
        ]);

        $item4 = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 10000
        ]);

        $item5 = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo',
            'precio_maximo' => 10000
        ]);

        OfertaXItem::create([
            'user_id' => $user3->id,
            'item_id' => $item1->id,
            'oferta' => 1000
        ]);

        $array = [];
        array_push($array,[
            'item_id' => $item1->id,
            'oferta' => 1500
        ]);
        array_push($array,[
            'item_id' => $item2->id,
            'oferta' => ''
        ]);
        array_push($array,[
            'item_id' => $item3->id,
            'oferta' => ''
        ]);
        array_push($array,[
            'item_id' => $item4->id,
            'oferta' => ''
        ]);
        array_push($array,[
            'item_id' => $item5->id,
            'oferta' => ''
        ]);

        $this->actingAs($user)->post('/ofertasxitems/ofertar',[
            'data' => json_encode($array)
        ])
            ->assertJson([
                'title' => 'Tus ofertas no pudieron ser registradas',
                'message' => "Algunas ofertas no se guardaron porque otras son superiores"
            ],200)
        ;

    }

    /** @test */
    function test_an_user_can_delete_an_oferta()
    {
        $this->withoutExceptionHandling();
        $this->seed('CategoriasSeeder');
        $this->seed('SubcategoriasSeeder');
        $user = $this->generateUser('username','pollitofive');
        $user2 = $this->generateUser('username','pollitofive2');

        $proceso = Proceso::Create([
            'user_id' => $user->id,
            'estado' => 'Activo'
        ]);

        $item = factory(Item::class)->create([
            'user_id' => $user2->id,
            'proceso_id' => $proceso->id,
            'subcategoria_id' => '2',
            'estado' => 'Activo'
        ]);

        OfertaXItem::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'oferta' => 200
        ]);

        $this->actingAs($user)->post('ajax_eliminar_oferta',[
            'item_id' => $item->id
        ])
            ->assertJson([
                'mensaje' => 'OK',
            ],200)
        ;

        $this->assertSoftDeleted('ofertasxitems',[
            'user_id' => $user->id,
            'item_id' => $item->id,
            'oferta' => 200
        ]);
    }


}
