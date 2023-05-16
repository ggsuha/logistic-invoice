<?php

namespace App\Http\Requests;

class PasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old'                   => 'required|current_password:web',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required_with:password',
        ];
    }

    /**
     * Set attribute's name.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'old'                   => 'password lama',
            'password'              => 'password baru',
            'password_confirmation' => 'konfirmasi password',
        ];
    }
}
