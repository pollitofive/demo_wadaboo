<?php

namespace Tests\Feature;

use App\User;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfiguracionValidacionesTest extends TestCase
{
    use RefreshDatabase,GenerateDataUserTrait;

    /** @test */
    function a_user_cant_choose_an_username_taked()
    {
        factory(User::class)->create(['username' => 'pollitofive']);

        $user = factory(User::class)->create();

        $data = $this->generateDataParticular($user,['username' => 'pollitofive']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors(['username' => 'Ese usuario ya ha sido registrado.']);

    }

    /** @test */
    function a_username_is_required()
    {
        $user = factory(User::class)->create();

        $data = $this->generateDataParticular($user,['username' => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors(['username' => 'El campo usuario es obligatorio.']);

    }

    /** @test */
    function a_user_cant_choose_an_email_taked()
    {
        factory(User::class)->create(['email' => 'damian@damian.com']);

        $user = factory(User::class)->create();

        $data = $this->generateDataParticular($user,['email' => 'damian@damian.com']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors('email');

    }

    /** @test */
    function a_email_is_required()
    {
        $user = factory(User::class)->create();

        $data = $this->generateDataParticular($user,['email' => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors('email');

    }

    /** @test */
    function a_email_is_type_email()
    {
        $user = factory(User::class)->create();

        $data = $this->generateDataParticular($user,['email' => 'damian123']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors('email');

    }

    /** @test */
    function a_nombre_is_required_if_is_particular()
    {
        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,['part_nombre' => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors('part_nombre');

        $user = factory(User::class)->states('empresa')->create();

        $data = $this->generateDataEmpresa($user,['part_nombre' => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors('part_nombre');
    }

    /** @test */
    function an_apellido_is_required_if_is_particular()
    {
        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,['part_apellido' => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors('part_apellido');

        $user = factory(User::class)->states('empresa')->create();

        $data = $this->generateDataEmpresa($user,['part_apellido' => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors('part_apellido');
    }

    /** @test */
    function a_part_telefono_is_required_if_is_particular()
    {
        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,['part_telefono' => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors('part_telefono');

        $user = factory(User::class)->states('empresa')->create();

        $data = $this->generateDataEmpresa($user,['part_telefono' => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors('part_telefono');
    }

    /** @test */
    function a_part_nro_doc_is_required_if_is_particular()
    {
        $user = factory(User::class)->states('particular')->create();

        $field = 'part_nro_doc';
        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

        $user = factory(User::class)->states('empresa')->create();

        $data = $this->generateDataEmpresa($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors($field);
    }

    /** @test */
    function a_empresa_razon_social_is_required_if_is_empresa()
    {
        $user = factory(User::class)->states('empresa')->create();

        $field = 'empresa_razon_social';
        $data = $this->generateDataEmpresa($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors($field);
    }

    /** @test */
    function a_empresa_nombre_is_required_if_is_empresa()
    {
        $user = factory(User::class)->states('empresa')->create();

        $field = 'empresa_nombre';
        $data = $this->generateDataEmpresa($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors($field);
    }

    /** @test */
    function a_empresa_cuit_is_required_if_is_empresa()
    {
        $user = factory(User::class)->states('empresa')->create();

        $field = 'empresa_cuit';
        $data = $this->generateDataEmpresa($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors($field);
    }

    /** @test */
    function a_empresa_telefono_is_required_if_is_empresa()
    {
        $user = factory(User::class)->states('empresa')->create();

        $field = 'empresa_telefono';
        $data = $this->generateDataEmpresa($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors($field);
    }

    /** @test */
    function a_empresa_descripcion_is_required_if_is_empresa()
    {
        $user = factory(User::class)->states('empresa')->create();

        $field = 'empresa_descripcion';
        $data = $this->generateDataEmpresa($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors($field);
    }

    /** @test */
    function a_empresa_cargo_is_required_if_is_empresa()
    {
        $user = factory(User::class)->states('empresa')->create();

        $field = 'empresa_cargo';
        $data = $this->generateDataEmpresa($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors($field);
    }

    /** @test */
    function a_empresa_tamanio_is_required_if_is_empresa()
    {
        $user = factory(User::class)->states('empresa')->create();

        $field = 'empresa_tamanio';
        $data = $this->generateDataEmpresa($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

        $user = factory(User::class)->states('particular')->create();

        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionDoesntHaveErrors($field);
    }


    /** @test */
    function a_tipo_usuario_is_required()
    {
        $user = factory(User::class)->create();

        $data = $this->generateDataParticular($user,['tipo_usuario' => '']);
        $data['tipo_usuario'] = '';
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors('tipo_usuario');

    }

    /** @test */
    function a_calle_is_required()
    {
        $user = factory(User::class)->create();

        $field = 'calle';
        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

    }

    /** @test */
    function a_altura_is_required()
    {
        $user = factory(User::class)->create();

        $field = 'altura';
        $data = $this->generateDataParticular($user,[$field => '']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

    }

    /** @test */
    function a_codigo_postal_must_be_integer()
    {
        $user = factory(User::class)->create();

        $field = 'codigo_postal';
        $data = $this->generateDataParticular($user,[$field => '5.544']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

    }

    /** @test */
    function a_piso_must_be_integer()
    {
        $user = factory(User::class)->create();

        $field = 'piso';
        $data = $this->generateDataParticular($user,[$field => '5.544']);
        $this->actingAs($user)->post('users',$data)
            ->assertSessionHasErrors($field);

    }


}
