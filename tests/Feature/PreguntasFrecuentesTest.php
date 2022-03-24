<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PreguntasFrecuentesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_logged_user_can_see_preguntas_frecuentes()
    {
        $user = factory(User::class)->create();
        $test = $this->actingAs($user)->get('frequent-questions');
        $this->preguntas($test);
    }

    /** @test */
    function a_guest_user_can_see_preguntas_frecuentes()
    {
        $test = $this->get('faq');
        $this->preguntas($test);
    }

    function preguntas($test)
    {
        $test->assertSee('¿Qué es la subasta inversa electrónica?')
            ->assertSee('¿Cómo publico una subasta inversa?')
            ->assertSee('¿Cuánto tiempo dura una subasta inversa?')
            ->assertSee('¿Cuál es el monto mínimo para ofertar un proceso de subasta inversa?')
            ->assertSee('¿Cómo se realiza una oferta?')
            ->assertSee('¿Cuántas categorías de productos me permite agregar el proceso de la subasta inversa?')
            ->assertSee('¿Hay alguna sección de preguntas y respuestas?')
            ->assertSee('¿La empresa compradora debe adjudicarme si termina la subasta y voy ganando?')
            ->assertSee('¿Pueden suspender o cancelar mi usuario?')
            ->assertSee('¿Si una subasta inversa no recibe ofertas, puedo hacer otra subasta?')
            ->assertSee('¿Qué pasaría si cualquiera de las dos contrapartes no se contacta?')
            ->assertSee('¿Cuándo sé si efectivamente una subasta inversa ya está finalizada?')
            ->assertSee('Una vez adjudicado el proveedor, en cuánto tiempo máximo se debe completar la operación?')
            ->assertSee('¿Qué pasaría si no se completa la operación por algo en particular?')
            ->assertDontSee('15.');


    }

}
