<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function i_can_see_the_login()
    {
        $this->get('login')
        ->assertSee('Iniciar sesión')
        ->assertSee('Recordarme')
        ->assertSee('Entrar')
        ->assertSee('Registrar una cuenta gratis')
        ->assertSee('¿Olvidaste tu contraseña?');
    }

    /** @test */
    function error_login()
    {
        $this->post('login',[
            'username' => "DamianLadiani",
            'password' => "123456"
        ])->assertRedirect()->
        assertSessionHasErrors('username','Estas credenciales no coinciden con nuestros registros.');

    }


    /** @test */
    function a_user_can_loggin()
    {
        $user = factory(User::class)->create([
            'email' => 'damianladiani@gmail.com',
            'username' => 'pollitofive',
            'password' => bcrypt('1234')
        ]);

        $this->post('login',[
            'username' => $user->username,
            'password' => "1234"
        ])->assertRedirect();

        $this->get('/home')
            ->assertSee('Nueva publicación')
            ->assertSee('Publicaciones vigentes');

    }

    /** @test */
    function a_logged_user_can_see_the_menu()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get('/home')
            ->assertSee('Publicaciones')
            ->assertSee('Mis compras')
            ->assertSee('Mis ofertas')
            ->assertSee('Favoritos')
            ->assertSee('Preguntas frecuentes')
            ->assertSee('Configuración')
            ->assertSee('Configuración')
            ->assertSee('Cambiar contraseña')
            ->assertSee('Alertas')
            ->assertSee('Cerrar sesión');

    }


    /*
    function i_can_login()
    {
        $this->withExceptionHandling();
        $user = factory(User::class)->create([
            'username' => 'damian',
            'password' => 1234
        ]);



        $this->post('login',[
            'username' => "damian",
            'password' => "1234"
        ])->assertSee('Publicaciones vigentes');

    }
    */


}
