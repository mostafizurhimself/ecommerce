<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'firstName'  => ['required', 'string', 'between:2,100'],
                        'lastName'   => ['required', 'string', 'between:2,100'],
                        'email'      => ['required', 'email', Rule::unique('customers', 'email')],
                        'phone'      => ['required', 'regex:/(01)[0-9]{9}/'],
                        'password'   => ['required', 'min:6', 'max:20', 'confirmed'],
                        'image'      => ['sometimes', 'base64max:5120', 'base64mimes:png,jpg'],
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'firstName'  => ['required', 'string', 'between:2,100'],
                        'lastName'   => ['required', 'string', 'between:2,100'],
                        'email'      => ['required', 'email', Rule::unique('customers', 'email')->ignore($this->customer->id)],
                        'phone'      => ['required', 'regex:/(01)[0-9]{9}/'],
                        'password'   => ['nullable', 'min:6', 'max:20', 'confirmed'],
                        'image'      => ['nullable', 'base64max:5120', 'base64mimes:png,jpg'],
                    ];
                }
            default:
                break;
        }
    }
}