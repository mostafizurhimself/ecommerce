<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateProfileRequest extends FormRequest
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
            'firstName' => 'required|string|between:2,100',
            'lastName'  => 'required|string|between:2,100',
            'email'     => ['required', 'email', Rule::unique('customers', 'email')->ignore(auth()->user()->id)],
            'phone'     => ['required', 'min:10', Rule::unique('customers', 'phone')->ignore(auth()->user()->id)],
            'photo'     => ['sometimes', 'base64max:5120', 'base64mimes:png,jpg'],
        ];
    }
}