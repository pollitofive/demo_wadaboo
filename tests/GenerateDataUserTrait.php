<?php


namespace Tests;


use App\User;

trait GenerateDataUserTrait
{
    function generateUser($field,$value,$tipo='particular')
    {
        return factory(User::class)->states($tipo)->create([
            $field => $value,
            'provincia_id' => 1,
            'localidad_id' => 1,
        ]);

    }

    function generateDataParticular(User $user,$data = [])
    {
        return [
            'username' => $data['username'] ?? $user->username,
            'tipo_usuario' => 'Particular',
            'email' => $data['email'] ?? $user->email,
            'part_nombre' => $data['part_nombre'] ?? $user->part_nombre,
            'part_apellido' => $data['part_apellido'] ?? $user->part_apellido,
            'part_telefono' => $data['part_telefono'] ?? $user->part_telefono,
            'part_nro_doc' => $data['part_nro_doc'] ?? $user->part_nro_doc,
            'calle' => $data['calle'] ?? $user->calle,
            'altura' => $data['altura'] ?? $user->altura,
            'codigo_postal' => $data['codigo_postal'] ?? $user->codigo_postal,
            'provincia_id' => $data['provincia_id'] ?? $user->provincia_id,
            'localidad_id' => $data['localidad_id'] ?? $user->localidad_id,
            'piso' => $data['piso'] ?? $user->piso,
            'email_quien_recomendo_wadaboo' => $data['email_quien_recomendo_wadaboo'] ?? $user->email_quien_recomendo_wadaboo
        ];
    }

    function generateDataEmpresa(User $user,$data = [])
    {
        return [
            'username' => $data['username'] ?? $user->username,
            'email' => $data['email'] ?? $user->email,
            'tipo_usuario' => 'Empresa',
            'empresa_razon_social' => $data['empresa_razon_social'] ?? $user->empresa_razon_social,
            'empresa_nombre' => $data['empresa_nombre'] ?? $user->empresa_nombre,
            'empresa_cuit' => $data['empresa_cuit'] ?? $user->empresa_cuit,
            'empresa_cargo' => $data['empresa_cargo'] ?? $user->empresa_cargo,
            'empresa_telefono' => $data['empresa_telefono'] ?? $user->empresa_telefono,
            'empresa_descripcion' => $data['empresa_descripcion'] ?? $user->empresa_descripcion,
            'empresa_tamanio' => $data['empresa_tamanio'] ?? $user->empresa_tamanio,
            'calle' => $data['calle'] ?? $user->calle,
            'altura' => $data['altura'] ?? $user->altura,
            'codigo_postal' => $data['codigo_postal'] ?? $user->codigo_postal,
            'provincia_id' => $data['provincia_id'] ?? $user->provincia_id,
            'localidad_id' => $data['localidad_id'] ?? $user->localidad_id,
            'piso' => $data['piso'] ?? $user->piso,
        ];
    }
}
