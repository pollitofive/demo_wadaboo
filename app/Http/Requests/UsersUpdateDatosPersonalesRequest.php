<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateDatosPersonalesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = \Auth::user()->id;
        return [
            'tipo_usuario' => ['required'],
            'username' => ['required','max:50','unique:users,username,'.$user_id.',id', 'regex:/^\S*$/u'],
            'email' => ['required','email','max:50','unique:users,email,'.$user_id.',id'],
            'part_nombre' => ['required_if:tipo_usuario,Particular'],
            'part_apellido' => ['required_if:tipo_usuario,Particular'],
            'part_telefono' => ['required_if:tipo_usuario,Particular'],
            'part_nro_doc' => ['required_if:tipo_usuario,Particular'],
            'empresa_razon_social' => ['required_if:tipo_usuario,Empresa'],
            'empresa_nombre' => ['required_if:tipo_usuario,Empresa'],
            'empresa_cuit' => ['required_if:tipo_usuario,Empresa'],
            'empresa_telefono' => ['required_if:tipo_usuario,Empresa'],
            'empresa_descripcion' => ['required_if:tipo_usuario,Empresa'],
            'empresa_cargo' => ['required_if:tipo_usuario,Empresa'],
            'empresa_tamanio' => ['required_if:tipo_usuario,Empresa'],
            'calle' => ['required'],
            'altura' => ['required','numeric'],
            'provincia_id' => ['required'],
            'localidad_id' => ['required'],
            'codigo_postal' => ['nullable','integer'],
            'piso' => ['nullable','integer'],
            "email_quien_recomendo_wadaboo" => ['nullable','email']
        ];
    }

    public function messages()
    {
        return [
            'part_nombre.required_if' => __('validation.user.configuration.nombre-required-if'),
            'part_apellido.required_if' => __('validation.user.configuration.apellido-required-if'),
            'part_telefono.required_if' => __('validation.user.configuration.telefono-required-if'),
            'part_nro_doc.required_if' => __('validation.user.configuration.dni-required-if'),
            'empresa_razon_social.required_if' => __('validation.user.configuration.empresa-razon-social-required-if'),
            'empresa_nombre.required_if' => __('validation.user.configuration.empresa-nombre-required-if'),
            'empresa_cuit.required_if' => __('validation.user.configuration.empresa-cuit-required-if'),
            'empresa_telefono.required_if' => __('validation.user.configuration.empresa-telefono-required-if'),
            'empresa_descripcion.required_if' => __('validation.user.configuration.empresa-descripcion-required-if'),
            'empresa_cargo.required_if' => __('validation.user.configuration.empresa-cargo-required-if'),
            'empresa_tamanio.required_if' => __('validation.user.configuration.empresa-tamanio-required-if'),
            'cp.required' => __('validation.user.configuration.cp-required'),
            'provincia_id.required' => __('validation.user.configuration.provincia-id-required'),
            'localidad_id.required' => __('validation.user.configuration.localidad-id-required'),
            'email_quien_recomendo_wadaboo.email' => __('validation.user.configuration.email-quien-recomendo-wadaboo-email'),
        ];
    }

    public function guardar()
    {
        $data = $this->validated();

        $user = \Auth::user();

        $user->fill($data);
        $user->save();
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors
        \Session::flash('error',$errors->first());
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
