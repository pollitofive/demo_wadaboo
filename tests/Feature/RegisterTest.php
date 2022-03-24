<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function i_can_see_the_register_page()
    {
        $this->withExceptionHandling();
        $this->get('register')
            ->assertSee('¡Creá tu cuenta gratis!')
            ->assertSee('Nombre de usuario')
            ->assertSee('Email')
            ->assertSee('Contraseña')
            ->assertSee('Confirmar contraseña')
            ->assertSee('términos y condiciones')
            ->assertSee('Registrar')
            ->assertSee('¿Ya estás registrado?');
    }

    /** @test */
    function a_user_can_register()
    {
        $this->withoutExceptionHandling();

        Mail::fake();

        $data = $this->generateData();

        $response = $this->post('/register', $data);

        $response->assertRedirect('email/verify');

        $data = $this->unsetData($data);
        $this->assertDatabaseHas('users',$data);

    }

    /** @test */
    function a_user_sees_message_email_send()
    {
        $this->withoutExceptionHandling();
        Mail::fake();
        $data = $this->generateData();

        $response = $this->followingRedirects()->post('/register', $data);

        $response->assertSee('Por favor, verifica tu dirección de email');
        $response->assertSee('Te hemos enviado un email para que puedas verificar tu cuenta');
        $response->assertSee('Antes de continuar, por favor verifica tu email para la verificacion de la cuenta.');
        $response->assertSee('Si no lo recibiste, presiona aqui para reenviar');

        $data = $this->unsetData($data);

        $this->assertDatabaseHas('users',$data);

    }

    /** @test */
    function a_user_cant_take_an_username_used()
    {
        factory(User::class)->create(['username' => 'pollitofive']);

        $this->withExceptionHandling();

        $data = $this->generateData(['username' => 'pollitofive']);

        $this->post('/register',$data)
            ->assertSessionHasErrors(['username']);

        $this->assertDatabaseMissing('users',$data);
    }

    /** @test */
    function a_user_cant_take_an_email_used()
    {
        $this->withExceptionHandling();
        factory(User::class)->create(['email' => 'damian@damian.com']);

        $data = $this->generateData(['email' => 'damian@damian.com']);

        $this->post('/register',$data)
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users',$data);
    }

    /** @test */
    function the_password_and_confirmation_are_not_equals()
    {
        $this->withExceptionHandling();

        $data = $this->generateData(['password' => '123456','password_confirmation' => '12345678']);

        $this->post('/register',$data)
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users',$data);

    }

    /** @test */
    function the_user_acepts_terminos_y_condiciones()
    {
        $this->withExceptionHandling();

        $data = $this->generateData();
        unset($data['acepto_terminos']);

        $this->post('/register',$data)
            ->assertSessionHasErrors(['acepto_terminos']);

        $this->assertDatabaseMissing('users',$data);

    }

    /** @test */
    function the_email_has_the_correct_form()
    {
        $this->withExceptionHandling();

        $data = $this->generateData(['email' => 'damianladiani']);

        $this->post('/register',$data)
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users',$data);

    }

    private function generateData($data = [])
    {
        $faker = \Faker\Factory::create();

        $password = $faker->userName;

        return [
            'username' => trim($data['username'] ?? $faker->userName),
            'email' => $data['email'] ?? $faker->email,
            'password' => $data['password'] ?? $password,
            'password_confirmation' => $data['password_confirmation'] ?? $password,
            'acepto_terminos' => $data['acepto_terminos'] ?? true,
        ];
    }

    private function unsetData($data)
    {
        unset($data['acepto_terminos']);
        unset($data['password']);
        unset($data['password_confirmation']);

        return $data;
    }

}
