<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function a_user_can_changes_the_password()
    {
        $user = factory(User::class)->create(['password' => 'Usuario12']);

        $user->changePassword('123456');

        $user->refresh();

        $this->assertDatabaseHas('users',['password' => $user->password]);
    }

    function testGetDataOferta()
    {
        $user = (factory(User::class, 1)->states('particular')->create())->first();
        $user_object = $user->getDataOferta();
        $this->assertSame($user->part_nombre." ".$user->part_apellido,$user_object->nombre);
        $this->assertSame('',$user_object->cargo);
        $this->assertSame($user->part_telefono,$user_object->telefono);
        $this->assertSame($user->direccion_entrega,$user_object->direccion);
        $this->assertSame($user->email,$user_object->email);

        $user = (factory(User::class, 1)->states('empresa')->create())->first();
        $user_object = $user->getDataOferta();
        $this->assertSame($user->empresa_razon_social,$user_object->nombre);
        $this->assertSame($user->empresa_cargo,$user_object->cargo);
        $this->assertSame($user->empresa_telefono,$user_object->telefono);

        $this->assertSame($user->direccion_entrega,$user_object->direccion);
        $this->assertSame($user->email,$user_object->email);
    }

    function testGetNombreByTipoUsuario()
    {
        $user = (factory(User::class, 1)->states('particular')->create())->first();
        $this->assertSame($user->part_nombre." ".$user->part_apellido,$user->getNombreByTipoUsuario());

        $user = (factory(User::class, 1)->states('empresa')->create())->first();
        $this->assertSame($user->empresa_razon_social,$user->getNombreByTipoUsuario());
    }

    function testGetTelefonoByTipoUsuario()
    {
        $user = (factory(User::class, 1)->states('particular')->create())->first();
        $this->assertSame($user->part_telefono,$user->getTelefonoByTipoUsuario());

        $user = (factory(User::class, 1)->states('empresa')->create())->first();
        $this->assertSame($user->empresa_telefono,$user->getTelefonoByTipoUsuario());

    }

    function testPuedeOfertar()
    {
        $user = factory(User::class)->states('particular')->create(['tipo_usuario' => '']);
        $this->assertFalse($user->puedeOfertar());

        $user = factory(User::class)->states('particular')->create(['part_nombre' => '']);
        $this->assertFalse($user->puedeOfertar());

        $user = factory(User::class)->states('particular')->create(['part_apellido' => '']);
        $this->assertFalse($user->puedeOfertar());

        $user = factory(User::class)->states('particular')->create(['part_telefono' => '']);
        $this->assertFalse($user->puedeOfertar());

        $user = factory(User::class)->states('particular')->create();
        $this->assertTrue($user->puedeOfertar());

        $user = factory(User::class)->states('empresa')->create(['empresa_razon_social' => '']);
        $this->assertFalse($user->puedeOfertar());

        $user = factory(User::class)->states('empresa')->create(['empresa_telefono' => '']);
        $this->assertFalse($user->puedeOfertar());

        $user = factory(User::class)->states('empresa')->create();
        $this->assertTrue($user->puedeOfertar());
    }

    function testActualizarRecibeAlerta()
    {
        $user = factory(User::class)->states('particular')->create(['recibe_alertas' => '0']);
        $user->actualizarRecibeAlerta(1);
        $this->assertDatabaseHas('users',[
            'recibe_alertas' => 1
        ]);

        $this->refreshTestDatabase();

        $user = factory(User::class)->states('particular')->create(['recibe_alertas' => '1']);
        $user->actualizarRecibeAlerta(0);
        $this->assertDatabaseHas('users',[
            'recibe_alertas' => 0
        ]);

    }



}
