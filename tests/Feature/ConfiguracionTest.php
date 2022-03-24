<?php

namespace Tests\Feature;

use App\User;
use Tests\GenerateDataUserTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfiguracionTest extends TestCase
{
    use RefreshDatabase,GenerateDataUserTrait;

    /** @test */
    function an_user_can_see_configuracion()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->states('particular')->create();

        $this->actingAs($user)->get('my-accounts-settings')
            ->assertSee('Nombre de usuario')
            ->assertSee($user->username)
            ->assertSee('E-Mail')
            ->assertSee($user->email)
            ->assertSee('¿Quien te recomendó Wadaboo? Ingresá el E-Mail')
            ->assertSee($user->email_recomendo_wadaboo)
            ->assertSee('Nombre')
            ->assertSee($user->part_nombre)
            ->assertSee('Apellido')
            ->assertSee($user->part_apellido)
            ->assertSee('Teléfono')
            ->assertSee($user->part_telefono)
            ->assertSee('Nro de documento')
            ->assertSee($user->part_nro_doc)
            ->assertSee('Calle')
            ->assertSee($user->calle)
            ->assertSee('Altura')
            ->assertSee($user->altura)
            ->assertSee('Piso')
            ->assertSee($user->piso)
            ->assertSee('Código Postal')
            ->assertSee($user->codigo_postal);


        $user = factory(User::class)->states('empresa')->create([
            'empresa_descripcion' => 'Empresa grande no tan grande'
        ]);

        $this->actingAs($user)->get('my-accounts-settings')
            ->assertSee('Nombre de usuario')
            ->assertSee($user->username)
            ->assertSee('E-Mail')
            ->assertSee($user->email)
            ->assertSee('¿Quien te recomendó Wadaboo? Ingresá el E-Mail')
            ->assertSee($user->email_recomendo_wadaboo)
            ->assertSee('Razón social')
            ->assertSee($user->empresa_razon_social)
            ->assertSee('Nombre fantasía')
            ->assertSee($user->empresa_nombre)
            ->assertSee('Cuit')
            ->assertSee($user->empresa_cuit)
            ->assertSee('Teléfono de contacto')
            ->assertSee($user->empresa_telefono)
            ->assertSee('Actividad de la empresa')
            ->assertSee($user->empresa_descripcion)
            ->assertSee('¿Qué cargo ocupás?')
            ->assertSee($user->empresa_cargo)
            ->assertSee('¿Cantidad de personal?')
            ->assertSee($user->empresa_tamanio)
            ->assertSee('Calle')
            ->assertSee($user->calle)
            ->assertSee('Altura')
            ->assertSee($user->altura)
            ->assertSee('Piso')
            ->assertSee($user->piso)
            ->assertSee('Código Postal')
            ->assertSee($user->codigo_postal);
    }

    /** @test */
    function an_user_can_see_message_perfil_actualizado()
    {
        $field = 'username';
        $user = $this->generateUser($field,'pollitofive');

        $data = $this->generateDataParticular($user,[$field => 'pollitofive_cambio']);

        $response = $this->actingAs($user)->followingRedirects()->post('users', $data);

        $response->assertSee('Su perfil fue actualizado con éxito, podés empezar a operar en el sitio.');
    }

    /** @test */
    function an_user_can_change_his_username()
    {
        $field = 'username';
        $user = $this->generateUser($field,'pollitofive');

        $data = $this->generateDataParticular($user,[$field => 'pollitofive_actualizado']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'pollitofive_actualizado']);
        $this->assertDatabaseMissing('users',[$field => 'damian@damian.com']);
    }

    /** @test */
    function an_user_can_change_his_tipo_usuario()
    {
        $field = 'tipo_usuario';
        $user = $this->generateUser($field,'Particular');

        $user->empresa_razon_social = 'Empresa 1';
        $user->empresa_nombre = 'Empresa 1';
        $user->empresa_cuit = '20337947027';
        $user->empresa_telefono = '20721072';
        $user->empresa_descripcion = 'Descripcion de la empresa';
        $user->empresa_cargo = 'Programador';
        $user->empresa_tamanio = 'Mas de 20';
        $data = $this->generateDataEmpresa($user);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Empresa']);
        $this->assertDatabaseMissing('users',[$field => 'Particular']);
    }


    /** @test */
    function an_user_can_change_his_email()
    {
        $field = 'email';
        $user = $this->generateUser($field,'damian@damian.com');

        $data = $this->generateDataParticular($user,[$field => 'damian@damian2.com']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'damian@damian2.com']);
        $this->assertDatabaseMissing('users',[$field => 'damian@damian.com']);
    }

    /** @test */
    function an_user_can_change_email_quien_recomendo_wadaboo()
    {
        $field = 'email_quien_recomendo_wadaboo';
        $user = $this->generateUser($field,'damian@damian.com');

        $data = $this->generateDataParticular($user,[$field => 'damian@damian2.com']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'damian@damian2.com']);
        $this->assertDatabaseMissing('users',[$field => 'damian@damian.com']);
    }

    /** @test */
    function a_particular_user_can_change_his_nombre()
    {
        $field = 'part_nombre';

        $user = $this->generateUser($field,'Damian');

        $data = $this->generateDataParticular($user,[$field => 'Damian Leandro']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Damian Leandro']);
        $this->assertDatabaseMissing('users',[$field => 'Damian']);
    }

    /** @test */
    function a_particular_user_can_change_his_apellido()
    {
        $field = 'part_apellido';

        $user = $this->generateUser($field,'Ladiani');

        $data = $this->generateDataParticular($user,[$field => 'Ladiani DLL']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Ladiani DLL']);
        $this->assertDatabaseMissing('users',[$field => 'Ladiani']);
    }

    /** @test */
    function a_particular_user_can_change_his_telefono()
    {
        $field = 'part_telefono';

        $user = $this->generateUser($field,'1558140669');

        $data = $this->generateDataParticular($user,[$field => '20721072']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '20721072']);
        $this->assertDatabaseMissing('users',[$field => '1558140669']);
    }

    /** @test */
    function a_particular_user_can_change_his_nro_documento()
    {
        $field = 'part_nro_doc';

        $user = $this->generateUser($field,'33777888');

        $data = $this->generateDataParticular($user,[$field => '33000000']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '33000000']);
        $this->assertDatabaseMissing('users',[$field => '33777888']);
    }

    /** @test */
    function an_empresa_user_can_change_its_empresa_razon_social()
    {
        $field = 'empresa_razon_social';

        $user = $this->generateUser($field,'Empresa 1','empresa');

        $data = $this->generateDataEmpresa($user,[$field => 'Empresa 2']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Empresa 2']);
        $this->assertDatabaseMissing('users',[$field => 'Empresa 1']);
    }

    /** @test */
    function an_empresa_user_can_change_its_empresa_nombre()
    {
        $field = 'empresa_nombre';

        $user = $this->generateUser($field,'Empresa 1','empresa');

        $data = $this->generateDataEmpresa($user,[$field => 'Empresa 2']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Empresa 2']);
        $this->assertDatabaseMissing('users',[$field => 'Empresa 1']);
    }

    /** @test */
    function an_empresa_user_can_change_its_empresa_cuit()
    {
        $field = 'empresa_cuit';

        $user = $this->generateUser($field,'20337947027','empresa');

        $data = $this->generateDataEmpresa($user,[$field => '20337947028']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '20337947028']);
        $this->assertDatabaseMissing('users',[$field => '20337947027']);
    }

    /** @test */
    function an_empresa_user_can_change_its_empresa_cargo()
    {
        $field = 'empresa_cargo';

        $user = $this->generateUser($field,'Programador','empresa');

        $data = $this->generateDataEmpresa($user,[$field => 'Desarrollador']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Desarrollador']);
        $this->assertDatabaseMissing('users',[$field => 'Programador']);
    }

    /** @test */
    function an_empresa_user_can_change_its_empresa_telefono()
    {
        $field = 'empresa_telefono';

        $user = $this->generateUser($field,'1558140669','empresa');

        $data = $this->generateDataEmpresa($user,[$field => '20721072']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '20721072']);
        $this->assertDatabaseMissing('users',[$field => '1558140669']);
    }

    /** @test */
    function an_empresa_user_can_change_its_empresa_descripcion()
    {
        $field = 'empresa_descripcion';

        $user = $this->generateUser($field,'Descripcion de la empresa','empresa');

        $data = $this->generateDataEmpresa($user,[$field => 'Nueva descripcion de la empresa']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Nueva descripcion de la empresa']);
        $this->assertDatabaseMissing('users',[$field => 'Descripcion de la empresa']);
    }

    /** @test */
    function an_empresa_user_can_change_its_empresa_tamanio()
    {
        $field = 'empresa_tamanio';

        $user = $this->generateUser($field,'Entre 10 y 20','empresa');

        $data = $this->generateDataEmpresa($user,[$field => 'Mas de 20']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Mas de 20']);
        $this->assertDatabaseMissing('users',[$field => 'Entre 10 y 20']);
    }

    /** @test */
    function an_empresa_user_can_change_its_calle()
    {
        $field = 'calle';

        $user = $this->generateUser($field,'Almafuerte','empresa');

        $data = $this->generateDataEmpresa($user,[$field => 'Mexico']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Mexico']);
        $this->assertDatabaseMissing('users',[$field => 'Almafuerte']);
    }

    /** @test */
    function a_particular_user_can_change_his_calle()
    {
        $field = 'calle';

        $user = $this->generateUser($field,'Almafuerte');

        $data = $this->generateDataParticular($user,[$field => 'Mexico']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 'Mexico']);
        $this->assertDatabaseMissing('users',[$field => 'Almafuerte']);
    }

    /** @test */
    function an_empresa_user_can_change_its_altura()
    {
        $field = 'altura';

        $user = $this->generateUser($field,'4488','empresa');

        $data = $this->generateDataEmpresa($user,[$field => '12']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '12']);
        $this->assertDatabaseMissing('users',[$field => '4488']);
    }

    /** @test */
    function a_particular_user_can_change_his_altura()
    {
        $field = 'altura';

        $user = $this->generateUser($field,'4488');

        $data = $this->generateDataParticular($user,[$field => '12']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '12']);
        $this->assertDatabaseMissing('users',[$field => '4488']);
    }

    /** @test */
    function an_empresa_user_can_change_its_piso()
    {
        $field = 'piso';

        $user = $this->generateUser($field,'1','empresa');

        $data = $this->generateDataEmpresa($user,[$field => '2']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '2']);
        $this->assertDatabaseMissing('users',[$field => '1']);
    }

    /** @test */
    function a_particular_user_can_change_his_piso()
    {
        $field = 'piso';

        $user = $this->generateUser($field,'1');

        $data = $this->generateDataParticular($user,[$field => '2']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '2']);
        $this->assertDatabaseMissing('users',[$field => '1']);
    }

    /** @test */
    function an_empresa_user_can_change_its_codigo_postal()
    {
        $field = 'codigo_postal';

        $user = $this->generateUser($field,'1615','empresa');

        $data = $this->generateDataEmpresa($user,[$field => '1615']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '1615']);
        $this->assertDatabaseMissing('users',[$field => '1605']);
    }

    /** @test */
    function a_particular_user_can_change_his_codigo_postal()
    {
        $field = 'codigo_postal';

        $user = $this->generateUser($field,'1615');

        $data = $this->generateDataParticular($user,[$field => '1615']);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => '1615']);
        $this->assertDatabaseMissing('users',[$field => '1605']);
    }

    /** @test */
    function an_empresa_user_can_change_its_provincia()
    {
        $field = 'provincia_id';

        $user = $this->generateUser($field,'1','empresa');

        $data = $this->generateDataEmpresa($user,[$field => 2]);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 2]);
        $this->assertDatabaseMissing('users',[$field => 1]);
    }

    /** @test */
    function a_particular_user_can_change_his_provincia()
    {
        $field = 'provincia_id';

        $user = $this->generateUser($field,'1');

        $data = $this->generateDataParticular($user,[$field => 2]);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 2]);
        $this->assertDatabaseMissing('users',[$field => 1]);
    }

    /** @test */
    function an_empresa_user_can_change_its_localidad()
    {
        $field = 'localidad_id';

        $user = $this->generateUser($field,'1','empresa');

        $data = $this->generateDataEmpresa($user,[$field => 2]);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 2]);
        $this->assertDatabaseMissing('users',[$field => 1]);
    }

    /** @test */
    function a_particular_user_can_change_his_localidad()
    {
        $field = 'localidad_id';

        $user = $this->generateUser($field,'1');

        $data = $this->generateDataParticular($user,[$field => 2]);

        $response = $this->actingAs($user)->post('users', $data);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users',[$field => 2]);
        $this->assertDatabaseMissing('users',[$field => 1]);
    }

}
