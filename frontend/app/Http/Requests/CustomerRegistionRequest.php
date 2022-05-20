<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegistionRequest extends FormRequest
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
            'firstName'     => ['required', 'string', 'between:2,100'],
            'lastName'      => ['required', 'string', 'between:2,100'],
            'email'         => ['required', 'email', 'max:100', 'unique:customers'],
            'phone'         => ['required', 'regex:/(01)[0-9]{9}/'],
            'password'      => ['required', 'string', 'confirmed', 'min:6', 'max:20'],
        ];
    }
}