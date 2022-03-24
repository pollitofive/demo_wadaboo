<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;

class CartelesTest extends TestCase
{
    use RefreshDatabase,GenerateDataUserTrait;

    /** @test */
    function test_segui_el_avance_de_tus_subastas()
    {
        $user = factory(User::class)->states('particular')->create();
        $this->actingAs($user)->get('my-purchases')
            ->assertSee('Seguí el avance de tus subastas.')
            ->assertSee('Podrás editar tus publicaciones siempre y cuando no tengan ofertas.');

    }

    /** @test */
    function test_subastas_en_las_que_participas()
    {
        $user = factory(User::class)->states('particular')->create();
        $this->actingAs($user)->get('my-offers')
            ->assertSee('Subastas en las que participas.')
            ->assertSee('Podés actualizar tus ofertas desde acá o hacer click en el #Subasta para verla completa.');

    }

    /** @test */
    function test_subastas_en_las_que_ganaste()
    {
        $user = factory(User::class)->states('particular')->create();
        $this->actingAs($user)->get('my-offers')
            ->assertSee('Subastas en las que ganaste.')
            ->assertSee('Ponete en contacto con los compradores y concretá tu venta.')
            ->assertSee('Podés filtrar el listado o descargar los datos a Excel');

    }

    /** @test */
    function test_calificaciones_de_subastas()
    {
        $user = factory(User::class)->states('particular')->create();
        $this->actingAs($user)->get('my-offers')
            ->assertSee('Calificaciones de subastas')
            ->assertSee('Si concretaste la operación, te pedimos calificar al comprador.')
            ->assertSee('Si por alguna razón no se conctretó la operación, selecciona un motivo.');

    }

}
