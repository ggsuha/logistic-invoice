<?php

namespace App\Http\Requests;

class ProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'    => 'required',
            'phone'   => 'required',
            'address' => 'required',
            'header'  => 'required',
            'logo'    => 'nullable',
        ];
    }
}
