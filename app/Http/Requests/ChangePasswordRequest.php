<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        return [
            'password' => ['required',function ($attribute, $value, $fail) {
                if (!\Hash::check($value, auth()->user()->password)) {
                    return $fail(__('validation.change-password.password-incorrect'));
                }
            }],
            'new_password' => 'min:6|confirmed|different:password'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => __('validation.change-password.password-required'),
            'new_password.required' => __('validation.change-password.new-password-required'),
            'new_password.different' => __('validation.change-password.new-password-different'),
            'new_password.min' => __('validation.change-password.new-password-win'),
            'new_password.confirmed' => __('validation.change-password.new-password-confirmed'),
        ];
    }

    public function save()
    {
        $data = $this->validated();

        auth()->user()->changePassword($data['new_password']);
    }

}
